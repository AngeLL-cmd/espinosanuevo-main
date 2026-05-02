<?php

namespace app\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Búsqueda semántica de navegación: embeddings (HF) + caché local + respaldo por palabras clave.
 */
class NavigationAiSearch extends \yii\base\Component
{
    public const CACHE_FILENAME = 'navigation-ai-embeddings.json';

    /** Umbral mínimo de similitud coseno para considerar el resultado “fiable” */
    public float $minCosineConfidence = 0.32;

    /** Máximo de secciones en la lista tras filtrar por relevancia */
    private const RESULTS_LIMIT = 6;

    /**
     * @return array<string, mixed>
     */
    public function search(string $query): array
    {
        $query = trim(mb_substr($query, 0, 500));
        if ($query === '') {
            return $this->errorPayload('Escribe qué buscas en el colegio.');
        }

        $catalog = $this->loadCatalog();
        if ($catalog === []) {
            return $this->errorPayload('El catálogo de páginas no está configurado.');
        }

        $cachePath = $this->getCachePath();
        $cache = is_file($cachePath) ? $this->readCache($cachePath) : null;

        $vector = null;
        $usedApi = false;

        $model = (string) (Yii::$app->params['huggingfaceEmbeddingModel'] ?? HuggingfaceClient::DEFAULT_EMBEDDING_MODEL);
        $token = (string) (Yii::$app->params['huggingfaceApiToken'] ?? '');
        if ($token !== '') {
            try {
                $client = new HuggingfaceClient([
                    'apiToken' => $token,
                    'embeddingModel' => $model,
                ]);
                $vector = $client->embedText($query);
                $usedApi = $vector !== [];
            } catch (\Throwable $e) {
                Yii::warning($e->getMessage(), __METHOD__);
            }
        }

        if (
            $cache !== null
            && isset($cache['model'])
            && isset($cache['items'])
            && is_array($cache['items'])
            && (string) $cache['model'] !== $model
        ) {
            Yii::warning(
                'Caché de embeddings generada con otro modelo (' . $cache['model'] . '); se ignora hasta volver a ejecutar navigation/build-embeddings.',
                __METHOD__
            );
            $cache = null;
        }

        $rankedRows = null;
        $method = 'keywords';

        if ($vector !== null && $vector !== [] && $cache !== null && isset($cache['items']) && is_array($cache['items'])) {
            $ranked = $this->rankByCosine($vector, $cache['items']);
            $ranked = $this->preferAdmisionForEnrollmentIntent($query, $ranked);
            $topCos = (float) ($ranked[0]['cosine'] ?? 0);
            if ($ranked !== [] && $topCos >= 0.01) {
                $rankedRows = $this->rowsFromEmbeddingRanked($ranked);
                $method = 'embeddings';
            }
        }

        if ($rankedRows === null) {
            $kw = $this->rankByKeywords($query, $catalog);
            $rankedRows = $this->rowsFromKeywordRanked($kw);
            $method = 'keywords';
        }

        if ($rankedRows === []) {
            return $this->errorPayload('No encontré una página relacionada. Prueba con otras palabras.');
        }

        if ($method === 'keywords' && (float) ($rankedRows[0]['sim'] ?? 0) <= 0.0) {
            return $this->errorPayload('No encontré una página relacionada. Prueba con otras palabras o términos más concretos.');
        }

        $rankedRows = $this->dedupeRankedRowsById($rankedRows);
        $rankedRows = $this->filterRankedRowsByRelevance($rankedRows, $method);
        $rankedRows = $this->applyEnrollmentIntentToRankedRows($query, $rankedRows);
        $rankedRows = $this->dedupeRankedRowsById($rankedRows);

        $slice = array_slice($rankedRows, 0, self::RESULTS_LIMIT);

        $results = [];
        foreach ($slice as $row) {
            $e = $row['entry'];
            if (!isset($e['route'])) {
                continue;
            }
            $results[] = [
                'id' => (string) ($e['id'] ?? ''),
                'title' => (string) ($e['title'] ?? ''),
                'url' => Url::to($e['route']),
                'score' => round((float) ($row['sim'] ?? 0), 4),
            ];
        }

        if ($results === []) {
            return $this->errorPayload('No encontré una página relacionada. Prueba con otras palabras.');
        }

        $firstSim = (float) ($rankedRows[0]['sim'] ?? 0);
        $sure = $method === 'embeddings' && $firstSim >= $this->minCosineConfidence;
        $message = $this->buildResultsIntroMessage($sure, $method);

        return [
            'ok' => true,
            'message' => $message,
            'title' => $results[0]['title'] ?? null,
            'url' => $results[0]['url'] ?? null,
            'method' => $method,
            'score' => $results[0]['score'] ?? null,
            'results' => $results,
            'alternatives' => [],
            'apiWarning' => $usedApi ? null : ($token === ''
                ? 'Las sugerencias se basan en coincidencias con el texto publicado en cada sección.'
                : 'La búsqueda avanzada no estuvo disponible en este momento; se muestran sugerencias por coincidencia de texto.'),
        ];
    }

    /**
     * @param array<int, array{cosine: float, entry: array<string, mixed>}> $ranked
     * @return array<int, array{entry: array<string, mixed>, sim: float}>
     */
    private function rowsFromEmbeddingRanked(array $ranked): array
    {
        $out = [];
        foreach ($ranked as $r) {
            if (!isset($r['entry'])) {
                continue;
            }
            $out[] = [
                'entry' => $r['entry'],
                'sim' => (float) ($r['cosine'] ?? 0),
            ];
        }

        return $out;
    }

    /**
     * @param array<int, array{kw: float, entry: array<string, mixed>}> $kw
     * @return array<int, array{entry: array<string, mixed>, sim: float}>
     */
    private function rowsFromKeywordRanked(array $kw): array
    {
        $out = [];
        foreach ($kw as $r) {
            if (!isset($r['entry'])) {
                continue;
            }
            $out[] = [
                'entry' => $r['entry'],
                'sim' => (float) ($r['kw'] ?? 0),
            ];
        }

        return $out;
    }

    /**
     * @param array<int, array{entry: array<string, mixed>, sim: float}> $rows
     * @return array<int, array{entry: array<string, mixed>, sim: float}>
     */
    private function dedupeRankedRowsById(array $rows): array
    {
        $seen = [];
        $out = [];
        foreach ($rows as $r) {
            $id = (string) ($r['entry']['id'] ?? '');
            if ($id === '' || isset($seen[$id])) {
                continue;
            }
            $seen[$id] = true;
            $out[] = $r;
        }

        return $out;
    }

    /**
     * Solo mantiene entradas muy cercanas al mejor resultado (evita listar casi todo el menú).
     *
     * @param array<int, array{entry: array<string, mixed>, sim: float}> $rows
     * @return array<int, array{entry: array<string, mixed>, sim: float}>
     */
    private function filterRankedRowsByRelevance(array $rows, string $method): array
    {
        if ($rows === []) {
            return [];
        }
        if (count($rows) === 1) {
            return $rows;
        }

        $top = (float) ($rows[0]['sim'] ?? 0);
        $out = [$rows[0]];

        if ($method === 'embeddings') {
            $band = max(0.045, $top * 0.07);
            $minRest = max(0.14, $top * 0.78);
            foreach (array_slice($rows, 1) as $r) {
                $s = (float) ($r['sim'] ?? 0);
                if ($s < $minRest) {
                    continue;
                }
                if ($s >= $top - $band) {
                    $out[] = $r;
                }
            }

            return $out;
        }

        $band = max(0.22, $top * 0.25);
        $minRest = max(0.06, $top * 0.38);
        foreach (array_slice($rows, 1) as $r) {
            $s = (float) ($r['sim'] ?? 0);
            if ($s < $minRest) {
                continue;
            }
            if ($s >= $top - $band) {
                $out[] = $r;
            }
        }

        return $out;
    }

    /**
     * Prioriza Admisión al inicio de la lista en consultas de matrícula/inscripción.
     *
     * @param array<int, array{entry: array<string, mixed>, sim: float}> $rows
     * @return array<int, array{entry: array<string, mixed>, sim: float}>
     */
    private function applyEnrollmentIntentToRankedRows(string $query, array $rows): array
    {
        if (!$this->queryLooksLikeEnrollment($query) || $rows === []) {
            return $rows;
        }

        $adm = $this->findCatalogEntryById('admision');
        if ($adm === null) {
            return $rows;
        }

        if (($rows[0]['entry']['id'] ?? '') === 'admision') {
            return $rows;
        }

        $out = [];
        $admPushed = false;
        foreach ($rows as $r) {
            if (($r['entry']['id'] ?? '') === 'admision') {
                if (!$admPushed) {
                    $out[] = ['entry' => $adm, 'sim' => 0.38];
                    $admPushed = true;
                }

                continue;
            }
            $out[] = $r;
        }

        if (!$admPushed) {
            array_unshift($out, ['entry' => $adm, 'sim' => 0.38]);
        }

        return $out;
    }

    private function buildResultsIntroMessage(bool $sure, string $method): string
    {
        if ($method === 'embeddings' && $sure) {
            return 'Secciones más relacionadas con su búsqueda (solo las que encajan bien). Pulse un título para abrir.';
        }

        if ($method === 'embeddings') {
            return 'Secciones que se acercan a su consulta. Pulse un título para abrir.';
        }

        return 'Secciones que coinciden mejor con las palabras indicadas. Pulse un título para abrir.';
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function loadCatalog(): array
    {
        $file = Yii::getAlias('@app/config/navigation-catalog.php');
        if (!is_file($file)) {
            return [];
        }

        $data = require $file;

        return is_array($data) ? $data : [];
    }

    private function getCachePath(): string
    {
        return Yii::getAlias('@runtime/' . self::CACHE_FILENAME);
    }

    /**
     * @return array<string, mixed>|null
     */
    private function readCache(string $path): ?array
    {
        $raw = @file_get_contents($path);
        if ($raw === false) {
            return null;
        }

        try {
            $data = Json::decode($raw);
        } catch (\Throwable $e) {
            return null;
        }

        return is_array($data) ? $data : null;
    }

    /**
     * @param float[] $queryVec
     * @param array<int, mixed> $items
     * @return array<int, array<string, mixed>>
     */
    private function rankByCosine(array $queryVec, array $items): array
    {
        $map = $this->catalogById();
        $scored = [];
        foreach ($items as $row) {
            if (!is_array($row) || !isset($row['embedding'], $row['id'])) {
                continue;
            }
            $emb = $row['embedding'];
            if (!is_array($emb) || $emb === []) {
                continue;
            }
            $id = (string) $row['id'];
            if (!isset($map[$id])) {
                continue;
            }
            $cos = $this->cosineSimilarity($queryVec, array_map('floatval', $emb));
            $scored[] = [
                'cosine' => $cos,
                'entry' => $map[$id],
            ];
        }

        usort($scored, static function ($a, $b) {
            return ($b['cosine'] <=> $a['cosine']);
        });

        return $scored;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private function catalogById(): array
    {
        $out = [];
        foreach ($this->loadCatalog() as $row) {
            if (isset($row['id'])) {
                $out[(string) $row['id']] = $row;
            }
        }

        return $out;
    }

    /**
     * @param float[] $a
     * @param float[] $b
     */
    private function cosineSimilarity(array $a, array $b): float
    {
        if (count($a) !== count($b) || count($a) === 0) {
            return 0.0;
        }

        $n = count($a);

        $dot = 0.0;
        $na = 0.0;
        $nb = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $dot += $a[$i] * $b[$i];
            $na += $a[$i] * $a[$i];
            $nb += $b[$i] * $b[$i];
        }

        if ($na <= 0.0 || $nb <= 0.0) {
            return 0.0;
        }

        return $dot / (sqrt($na) * sqrt($nb));
    }

    /**
     * @param array<int, array<string, mixed>> $catalog
     * @return array<int, array<string, mixed>>
     */
    private function rankByKeywords(string $query, array $catalog): array
    {
        $scored = [];
        foreach ($catalog as $entry) {
            $corpus = mb_strtolower((string) ($entry['corpus'] ?? '') . ' ' . ($entry['title'] ?? ''));
            $kw = $this->keywordScore(mb_strtolower($query), $corpus);
            $scored[] = ['kw' => $kw, 'entry' => $entry];
        }

        if ($this->queryLooksLikeEnrollment($query)) {
            foreach ($scored as &$row) {
                if (($row['entry']['id'] ?? '') === 'admision') {
                    $row['kw'] += 0.45;
                }
            }
            unset($row);
        }

        usort($scored, static function ($x, $y) {
            return ($y['kw'] <=> $x['kw']);
        });

        return $scored;
    }

    /**
     * Coincidencia por palabras completas (no subcadenas: "como" ya no cuenta dentro de "comunicados").
     *
     * @return float entre 0 y 1 sobre palabras con significado (sin vacías de español)
     */
    private function keywordScore(string $query, string $corpus): float
    {
        $corpusTokens = $this->tokenizeToNormalizedSet($corpus);
        $words = preg_split('/[\s,.;:!?¿¡()\[\]"\']+/u', $query, -1, PREG_SPLIT_NO_EMPTY);
        if ($words === false || $words === []) {
            return 0.0;
        }

        $meaningful = [];
        foreach ($words as $w) {
            $w = mb_strtolower($w);
            if (mb_strlen($w) < 2) {
                continue;
            }
            if ($this->isSpanishStopWord($w)) {
                continue;
            }
            $meaningful[] = $this->normalizeAccents($w);
        }

        if ($meaningful === []) {
            return 0.0;
        }

        $hits = 0;
        foreach ($meaningful as $nw) {
            if (isset($corpusTokens[$nw])) {
                $hits++;
            }
        }

        return $hits / count($meaningful);
    }

    /**
     * @return array<string, true>
     */
    private function tokenizeToNormalizedSet(string $text): array
    {
        $words = preg_split('/[\s,.;:!?¿¡()\[\]"\']+/u', mb_strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
        if ($words === false || $words === []) {
            return [];
        }

        $set = [];
        foreach ($words as $w) {
            if (mb_strlen($w) < 2) {
                continue;
            }
            $set[$this->normalizeAccents($w)] = true;
        }

        return $set;
    }

    private function normalizeAccents(string $word): string
    {
        static $from = ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', 'à', 'è', 'ì', 'ò', 'ù'];
        static $to = ['a', 'e', 'i', 'o', 'u', 'u', 'n', 'a', 'e', 'i', 'o', 'u'];

        return str_replace($from, $to, $word);
    }

    private function isSpanishStopWord(string $w): bool
    {
        static $stop = [
            'a', 'al', 'algo', 'ante', 'como', 'con', 'cual', 'cuando', 'de', 'del', 'desde', 'donde', 'el', 'ella', 'ellas', 'ello', 'ellos', 'en', 'esa', 'esas', 'ese', 'eso', 'esos', 'esta', 'este', 'esto', 'estos', 'ha', 'han', 'hay', 'he', 'la', 'las', 'le', 'les', 'lo', 'los', 'mas', 'me', 'mi', 'mis', 'muy', 'no', 'nos', 'o', 'os', 'para', 'por', 'que', 'se', 'si', 'sin', 'sobre', 'su', 'sus', 'te', 'tu', 'tus', 'u', 'un', 'una', 'uno', 'unos', 'unas', 'y', 'ya', 'yo',
        ];
        static $stopSet = null;
        if ($stopSet === null) {
            $stopSet = array_fill_keys($stop, true);
        }

        return isset($stopSet[$this->normalizeAccents(mb_strtolower($w))]);
    }

    private function queryLooksLikeEnrollment(string $query): bool
    {
        return (bool) preg_match(
            '/matr[ií]cul|matricular|inscrib|admisi|formaliz|nuevo\s+ingreso|proceso\s+de\s+admisi|valida(r)?\s+tu\s+pago|solicita(r)?\s+tu\s+c[oó]digo/i',
            mb_strtolower($query)
        );
    }

    /**
     * @return array<string, mixed>|null
     */
    private function findCatalogEntryById(string $id): ?array
    {
        foreach ($this->loadCatalog() as $row) {
            if (($row['id'] ?? '') === $id) {
                return $row;
            }
        }

        return null;
    }

    /**
     * Si la consulta es de matrícula/admisión y Admisión va muy cerca en similitud, prioriza esa sección frente a otras
     * (p. ej. noticias que hablen de admisión).
     *
     * @param array<int, array{cosine: float, entry: array<string, mixed>}> $ranked
     * @return array<int, array{cosine: float, entry: array<string, mixed>}>
     */
    private function preferAdmisionForEnrollmentIntent(string $query, array $ranked): array
    {
        if ($ranked === [] || !$this->queryLooksLikeEnrollment($query)) {
            return $ranked;
        }
        if ((string) ($ranked[0]['entry']['id'] ?? '') === 'admision') {
            return $ranked;
        }

        $admIdx = null;
        foreach ($ranked as $i => $row) {
            if (($row['entry']['id'] ?? '') === 'admision') {
                $admIdx = $i;
                break;
            }
        }
        if ($admIdx === null) {
            return $ranked;
        }

        $topCos = (float) ($ranked[0]['cosine'] ?? 0);
        $admCos = (float) ($ranked[$admIdx]['cosine'] ?? 0);
        if ($admCos < 0.18) {
            return $ranked;
        }
        if (($topCos - $admCos) > 0.14) {
            return $ranked;
        }

        $admRow = $ranked[$admIdx];
        unset($ranked[$admIdx]);

        return array_values(array_merge([$admRow], $ranked));
    }

    /**
     * @return array<string, mixed>
     */
    private function errorPayload(string $message): array
    {
        return [
            'ok' => false,
            'message' => $message,
            'title' => null,
            'url' => null,
            'method' => null,
            'score' => null,
            'results' => [],
            'alternatives' => [],
            'apiWarning' => null,
        ];
    }
}
