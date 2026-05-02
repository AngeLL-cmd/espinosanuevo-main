<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;

$noticias = [
    ['img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Enero 15', 'autor' => 'Carlos Arigue', 'titulo' => '"Inicio del Proceso de Admisión 2026"'],
    ['img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 2', 'autor' => 'Carlos Arigue', 'titulo' => '"Ganadores del Concurso de Robótica Distrital"'],
    ['img' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 25', 'autor' => 'Carlos Arigue', 'titulo' => '"Rol de Exámenes Mensuales - Marzo"'],
    ['img' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Enero 15', 'autor' => 'Carlos Arigue', 'titulo' => '"Inicio del Proceso de Admisión 2026"'],
    ['img' => 'https://images.unsplash.com/photo-1511629091441-ee46146481b6?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 2', 'autor' => 'Carlos Arigue', 'titulo' => '"Ganadores del Concurso de Robótica Distrital"'],
    ['img' => 'https://images.unsplash.com/photo-1522661067900-ab829854a57f?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 25', 'autor' => 'Carlos Arigue', 'titulo' => '"Rol de Exámenes Mensuales - Marzo"'],
    ['img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Enero 15', 'autor' => 'Carlos Arigue', 'titulo' => '"Inicio del Proceso de Admisión 2026"'],
    ['img' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 2', 'autor' => 'Carlos Arigue', 'titulo' => '"Ganadores del Concurso de Robótica Distrital"'],
    ['img' => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=600&q=80', 'fecha' => 'Febrero 25', 'autor' => 'Carlos Arigue', 'titulo' => '"Rol de Exámenes Mensuales - Marzo"'],
];
?>

<!-- Hero Noticias -->
<section class="noticias-hero position-relative text-white">
    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=2400&q=80" 
        alt="Biblioteca" class="noticias-hero-img">
    <div class="noticias-hero-overlay"></div>
    <div class="noticias-hero-caption">
        <h1 class="noticias-hero-title">Noticias</h1>
    </div>
</section>

<!-- Filtros -->
<section class="noticias-filtros py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <div class="dropdown">
                <button class="btn noticias-filtro-btn noticias-filtro-activo dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Año
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">2026</a></li>
                    <li><a class="dropdown-item" href="#">2025</a></li>
                    <li><a class="dropdown-item" href="#">2024</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn noticias-filtro-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Mes
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Enero</a></li>
                    <li><a class="dropdown-item" href="#">Febrero</a></li>
                    <li><a class="dropdown-item" href="#">Marzo</a></li>
                    <li><a class="dropdown-item" href="#">Abril</a></li>
                    <li><a class="dropdown-item" href="#">Mayo</a></li>
                    <li><a class="dropdown-item" href="#">Junio</a></li>
                    <li><a class="dropdown-item" href="#">Julio</a></li>
                    <li><a class="dropdown-item" href="#">Agosto</a></li>
                    <li><a class="dropdown-item" href="#">Septiembre</a></li>
                    <li><a class="dropdown-item" href="#">Octubre</a></li>
                    <li><a class="dropdown-item" href="#">Noviembre</a></li>
                    <li><a class="dropdown-item" href="#">Diciembre</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Grid de noticias -->
<section class="noticias-grid py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($noticias as $item): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card noticias-card h-100 border-0 shadow-sm">
                    <div class="position-relative overflow-hidden">
                        <img src="<?= Html::encode($item['img']) ?>" class="card-img-top noticias-card-img" alt="Noticia">
                        <span class="badge noticias-card-badge">Leer mas...</span>
                    </div>
                    <div class="card-body">
                        <small class="text-muted d-block mb-1"><?= Html::encode($item['fecha']) ?>, <?= Html::encode($item['autor']) ?></small>
                        <h5 class="card-title fw-bold text-dark-blue mb-0"><?= $item['titulo'] ?></h5>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
