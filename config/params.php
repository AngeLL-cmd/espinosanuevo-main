<?php

/**
 * Token Hugging Face: primero se usa la variable de entorno HUGGINGFACE_API_TOKEN (recomendado en servidor).
 * Si está vacía, se usa $huggingfaceApiTokenLocal (solo tu PC; no subas un token real a un repo público).
 */
$huggingfaceApiTokenLocal = '';

$huggingfaceApiToken = getenv('HUGGINGFACE_API_TOKEN');
if (!is_string($huggingfaceApiToken) || $huggingfaceApiToken === '') {
    $huggingfaceApiToken = $huggingfaceApiTokenLocal;
}

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    /**
     * Hugging Face (Inference Providers): https://huggingface.co/settings/tokens
     * Permisos: poder llamar a Inference Providers.
     */
    'huggingfaceApiToken' => $huggingfaceApiToken,
    /** Modelo en el Hub para embeddings (multilingüe). */
    'huggingfaceEmbeddingModel' => 'sentence-transformers/paraphrase-multilingual-MiniLM-L12-v2',
    /** Opcional: URL completa de feature-extraction si Hugging Face cambia la ruta del router. */
    // 'huggingfaceFeatureExtractionUrl' => '',
];
