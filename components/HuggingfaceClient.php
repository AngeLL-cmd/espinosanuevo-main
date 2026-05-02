<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Embeddings vía Hugging Face Inference Providers (router).
 *
 * La URL antigua api-inference.huggingface.co/models/... está deprecada (404).
 * Documentación: https://huggingface.co/docs/inference-providers/tasks/feature-extraction
 *
 * Token: https://huggingface.co/settings/tokens (permiso "Inference Providers" / lectura).
 */
class HuggingfaceClient extends Component
{
    public const DEFAULT_EMBEDDING_MODEL = 'sentence-transformers/paraphrase-multilingual-MiniLM-L12-v2';

    /** @var string */
    public $apiToken = '';

    /** @var string id del modelo en el Hub (org/repo) */
    public $embeddingModel = self::DEFAULT_EMBEDDING_MODEL;

    public int $timeout = 120;

    /**
     * @return float[]
     */
    public function embedText(string $text): array
    {
        $vectors = $this->embedTexts([$text]);

        return $vectors[0] ?? [];
    }

    /**
     * @param string[] $texts
     * @return array<int, float[]>
     */
    public function embedTexts(array $texts): array
    {
        if ($this->apiToken === '') {
            throw new \RuntimeException('Falta el token de Hugging Face (params huggingfaceApiToken).');
        }

        $url = $this->resolveFeatureExtractionUrl();
        $payload = json_encode(['inputs' => $texts], JSON_UNESCAPED_UNICODE);
        if ($payload === false) {
            throw new \RuntimeException('No se pudo codificar la petición JSON.');
        }

        $headers = [
            'Authorization: Bearer ' . $this->apiToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $raw = $this->curlPost($url, $payload, $headers);
        $httpCode = $raw['httpCode'];
        $body = $raw['body'];

        if ($body === '') {
            throw new \RuntimeException(
                'Respuesta vacía de Hugging Face (HTTP ' . $httpCode . '). Comprueba token y permisos de Inference Providers.'
            );
        }

        $decoded = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException($this->formatInferenceError($httpCode, $body));
        }

        if (!is_array($decoded)) {
            throw new \RuntimeException($this->formatInferenceError($httpCode, $body));
        }

        if (isset($decoded['error']) && is_string($decoded['error'])) {
            throw new \RuntimeException($decoded['error']);
        }

        if ($httpCode >= 400) {
            $msg = isset($decoded['error']) ? (string) $decoded['error'] : ('HTTP ' . $httpCode);
            throw new \RuntimeException($msg);
        }

        return $this->parseEmbeddingsResponse($decoded, count($texts));
    }

    /**
     * URL POST que se usará (útil para depurar: debe contener router.huggingface.co y /pipeline/feature-extraction).
     */
    public function getResolvedFeatureExtractionUrl(): string
    {
        return $this->resolveFeatureExtractionUrl();
    }

    /**
     * POST .../hf-inference/models/{org}/{repo}/pipeline/feature-extraction
     */
    private function resolveFeatureExtractionUrl(): string
    {
        $params = Yii::$app->params ?? [];
        $full = $params['huggingfaceFeatureExtractionUrl'] ?? null;
        if (is_string($full) && $full !== '') {
            return $full;
        }

        $modelPath = $this->modelIdToUrlPath($this->embeddingModel);

        return 'https://router.huggingface.co/hf-inference/models/' . $modelPath . '/pipeline/feature-extraction';
    }

    /**
     * Convierte org/repo en segmentos seguros para la URL (barras reales, no %2F en un solo segmento).
     */
    private function modelIdToUrlPath(string $modelId): string
    {
        $segments = explode('/', $modelId);

        return implode('/', array_map('rawurlencode', $segments));
    }

    /**
     * @param string[] $httpHeaders
     * @return array{body: string, httpCode: int}
     */
    private function curlPost(string $url, string $payload, array $httpHeaders): array
    {
        $ch = curl_init($url);
        if ($ch === false) {
            throw new \RuntimeException('No se pudo inicializar cURL.');
        }

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $httpHeaders,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $body = curl_exec($ch);
        $errno = curl_errno($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($body === false || $errno !== 0) {
            Yii::warning('Hugging Face cURL: ' . $errno . ' ' . $err, __METHOD__);
            throw new \RuntimeException('Error de red al llamar a Hugging Face: ' . $err);
        }

        return ['body' => (string) $body, 'httpCode' => $httpCode];
    }

    private function formatInferenceError(int $httpCode, string $body): string
    {
        $trim = trim($body);
        $hint = '';
        if ($trim !== '' && ($trim[0] === '<' || stripos($trim, '<!DOCTYPE') !== false || stripos($trim, '<html') !== false)) {
            $hint = ' El servidor devolvió HTML en lugar de JSON (endpoint antiguo, token o red).';
        }
        $snip = preg_replace('/\s+/', ' ', $trim);
        if (is_string($snip) && mb_strlen($snip) > 220) {
            $snip = mb_substr($snip, 0, 220) . '…';
        }

        return 'Respuesta no JSON de Hugging Face (HTTP ' . $httpCode . ').'
            . $hint
            . ($snip !== '' ? ' Detalle: ' . $snip : '');
    }

    /**
     * @param mixed $decoded
     * @return array<int, float[]>
     */
    private function parseEmbeddingsResponse($decoded, int $expectedCount): array
    {
        $out = [];

        if ($expectedCount === 1) {
            $vec = $this->flattenVector($decoded);
            if ($vec !== []) {
                return [$vec];
            }
        }

        if (is_array($decoded) && $decoded !== [] && isset($decoded[0])) {
            if (is_array($decoded[0]) && $this->isNumericVector($decoded[0])) {
                foreach ($decoded as $row) {
                    $vec = $this->flattenVector($row);
                    if ($vec !== []) {
                        $out[] = $vec;
                    }
                }
            } elseif (is_array($decoded[0]) && isset($decoded[0][0])) {
                foreach ($decoded as $row) {
                    $vec = $this->flattenVector($row);
                    if ($vec !== []) {
                        $out[] = $vec;
                    }
                }
            }
        }

        if (count($out) !== $expectedCount) {
            throw new \RuntimeException('Formato de embeddings inesperado de Hugging Face.');
        }

        return $out;
    }

    /**
     * @param mixed $data
     * @return float[]
     */
    private function flattenVector($data): array
    {
        if (!is_array($data) || $data === []) {
            return [];
        }

        if ($this->isNumericVector($data)) {
            return array_map('floatval', $data);
        }

        return $this->flattenVector($data[0]);
    }

    /**
     * @param mixed $data
     */
    private function isNumericVector($data): bool
    {
        if (!is_array($data) || $data === []) {
            return false;
        }

        return is_numeric($data[0]);
    }
}
