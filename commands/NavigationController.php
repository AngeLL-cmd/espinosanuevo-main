<?php

namespace app\commands;

use app\components\HuggingfaceClient;
use app\components\NavigationAiSearch;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Json;

/**
 * Genera caché de embeddings para la búsqueda de navegación (Hugging Face).
 *
 * Uso: php yii navigation/build-embeddings
 */
class NavigationController extends Controller
{
    /**
     * Calcula embeddings del catálogo y los guarda en runtime.
     */
    public function actionBuildEmbeddings(): int
    {
        $catalog = require Yii::getAlias('@app/config/navigation-catalog.php');
        if (!is_array($catalog) || $catalog === []) {
            $this->stderr("El catálogo está vacío.\n");

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $token = (string) (Yii::$app->params['huggingfaceApiToken'] ?? '');
        if ($token === '') {
            $this->stderr("Falta huggingfaceApiToken en params o la variable de entorno HUGGINGFACE_API_TOKEN.\n");

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $model = (string) (Yii::$app->params['huggingfaceEmbeddingModel'] ?? HuggingfaceClient::DEFAULT_EMBEDDING_MODEL);
        $client = new HuggingfaceClient([
            'apiToken' => $token,
            'embeddingModel' => $model,
        ]);
        $this->stdout('Llamando a: ' . $client->getResolvedFeatureExtractionUrl() . "\n");

        $texts = [];
        foreach ($catalog as $row) {
            $texts[] = (string) ($row['corpus'] ?? '');
        }

        $chunkSize = 6;
        $allEmbeddings = [];
        $offset = 0;
        $total = count($texts);

        while ($offset < $total) {
            $slice = array_slice($texts, $offset, $chunkSize);
            $attempt = 0;
            while (true) {
                try {
                    $batch = $client->embedTexts($slice);
                    foreach ($batch as $vec) {
                        $allEmbeddings[] = $vec;
                    }
                    break;
                } catch (\Throwable $e) {
                    $attempt++;
                    $this->stderr($e->getMessage() . "\n");
                    if ($attempt > 4) {
                        return ExitCode::UNSPECIFIED_ERROR;
                    }
                    $this->stdout("Reintento {$attempt}/4 en 20 segundos (cola o arranque del modelo en HF)...\n");
                    sleep(20);
                }
            }
            $offset += $chunkSize;
            if ($offset < $total) {
                sleep(2);
            }
        }

        if (count($allEmbeddings) !== $total) {
            $this->stderr('Número de embeddings distinto al del catálogo.' . "\n");

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $items = [];
        foreach ($catalog as $i => $row) {
            $items[] = [
                'id' => $row['id'],
                'embedding' => $allEmbeddings[$i],
            ];
        }

        $payload = [
            'model' => $model,
            'builtAt' => date('c'),
            'items' => $items,
        ];

        $path = Yii::getAlias('@runtime/' . NavigationAiSearch::CACHE_FILENAME);
        if (file_put_contents($path, Json::encode($payload)) === false) {
            $this->stderr("No se pudo escribir: {$path}\n");

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->stdout("Listo. Archivo generado:\n{$path}\n");

        return ExitCode::OK;
    }
}
