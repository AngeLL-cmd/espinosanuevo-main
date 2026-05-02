<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="' . Yii::getAlias('@web') . '/logo/logo_white.png" alt="ENE Logo" style="height: 75px;" class="me-2">',
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => ['class' => 'd-flex align-items-center text-decoration-none'],
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-custom-blue fixed-top shadow-sm py-3 ene-navbar']
        ]);

        // Elementos de navegación del lado izquierdo
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav mx-auto'],
            'items' => [
                ['label' => 'Inicio', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'nav-link fw-semibold']],
                ['label' => 'Admisión', 'url' => ['/site/admision'], 'linkOptions' => ['class' => 'nav-link fw-semibold']],
                [
                    'label' => 'Media',
                    'items' => [
                        ['label' => 'Galería', 'url' => ['/site/galeria']],
                        ['label' => 'Revista', 'url' => ['/site/revista']],
                        ['label' => 'Videos', 'url' => '#'],
                    ],
                    'linkOptions' => ['class' => 'nav-link fw-semibold']
                ],
            ]
        ]);

        // Botones del lado derecho
        echo '<div class="d-flex gap-2 align-items-center ene-nav-actions flex-wrap justify-content-end">';
        echo Html::button(
            '<i class="fas fa-search" aria-hidden="true"></i>',
            [
                'class' => 'btn btn-outline-light ene-ai-nav-trigger',
                'title' => 'Buscar en el sitio',
                'aria-label' => 'Buscar en el sitio',
                'data-bs-toggle' => 'modal',
                'data-bs-target' => '#eneAiNavModal',
                'type' => 'button',
            ]
        );
        echo Html::a('Aula virtual', '#', ['class' => 'btn ene-btn-virtual fw-bold px-4']);
        echo Html::a('Intranet', '#', ['class' => 'btn ene-btn-intranet fw-bold px-4']);
        echo '</div>';

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0 p-0" role="main">
        <div class="container-fluid p-0">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <div id="ene-ai-endpoint" class="d-none" data-url="<?= Html::encode(Url::to(['site/ai-navegar'])) ?>"></div>

    <div class="modal fade" id="eneAiNavModal" tabindex="-1" aria-labelledby="eneAiNavModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content ene-ai-nav-modal">
                <div class="modal-header bg-custom-blue text-white">
                    <h5 class="modal-title fw-bold" id="eneAiNavModalLabel">Buscador del sitio</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted mb-3">Indique con sus palabras qué necesita del colegio (una o varias palabras, o una frase breve) y pulse <strong>Buscar</strong>. <strong>Ejemplos:</strong> «matrícula» o «inscribir a mi hijo»; «fotos» o «galería»; «noticias» o «comunicados»; «profesores» o «equipo».</p>
                    <form id="eneAiNavForm" class="ene-ai-nav-form">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control" name="q" id="eneAiNavInput" maxlength="500"
                                placeholder="¿Qué buscas?" autocomplete="off">
                            <button class="btn btn-primary px-4 fw-bold" type="submit" id="eneAiNavSubmit">Buscar</button>
                        </div>
                    </form>
                    <div id="eneAiNavAlert" class="alert d-none" role="alert"></div>
                    <div id="eneAiNavResult" class="d-none">
                        <p id="eneAiNavMessage" class="small text-muted mb-2"></p>
                        <div id="eneAiNavResultsList" class="ene-ai-nav-results list-group mb-3 d-none" role="list"></div>
                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        <p id="eneAiNavWarning" class="small text-muted mt-3 d-none mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="mt-auto py-5 bg-custom-blue text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="mb-3">
                        <img src="<?= Yii::getAlias('@web') ?>/logo/logonombre.png" alt="Logo Nombre" class="img-fluid"
                            style="max-height: 60px;">
                    </div>
                    <div class="social-icons d-flex gap-3 fs-4">
                        <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3">Menú</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Inicio</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Admisión 2026</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Intranet</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Aula Virtual</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Home</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= \yii\helpers\Url::to(['/site/equipo']) ?>" class="text-white text-decoration-none mb-2 d-block">Nosotros</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Propuesta Educativa</a>
                        </li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Vida Escolar</a></li>
                        <li><a href="<?= \yii\helpers\Url::to(['/site/noticias']) ?>" class="text-white text-decoration-none mb-2 d-block">Comunicados y Noticias</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Descargables</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Municipio</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Himno Nacional</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Himno Espinosito</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">Android</a></li>
                        <li><a href="#" class="text-white text-decoration-none mb-2 d-block">iOS</a></li>
                    </ul>
                </div>
            </div>

            <hr class="border-light opacity-25 mt-4 mb-4">

            <div class="row">
                <div class="col-12 text-center small opacity-75">
                    Política de privacidad | Todos los derechos reservados
                    <span class="float-end"><i class="fas fa-arrow-up bg-warning text-white p-2 rounded"></i></span>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <script>
        window.addEventListener('scroll', function () {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
<?php $this->endPage() ?>