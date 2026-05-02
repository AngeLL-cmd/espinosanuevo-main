<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Galería';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="galeria-page">
<!-- Hero Galería -->
<section class="galeria-hero position-relative text-white">
    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=2400&q=80" 
        alt="Biblioteca" class="galeria-hero-img">
    <div class="galeria-hero-overlay"></div>
    <div class="galeria-hero-caption">
        <h1 class="galeria-hero-title">Galería de fotos</h1>
    </div>
</section>

<!-- Filtros -->
<section class="galeria-filtros py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <div class="dropdown">
                <button class="btn galeria-filtro-btn galeria-filtro-activo dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Año
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">2026</a></li>
                    <li><a class="dropdown-item" href="#">2025</a></li>
                    <li><a class="dropdown-item" href="#">2024</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn galeria-filtro-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
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
            <div class="dropdown">
                <button class="btn galeria-filtro-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Categoría
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Todas</a></li>
                    <li><a class="dropdown-item" href="#">Eventos</a></li>
                    <li><a class="dropdown-item" href="#">Actividades</a></li>
                    <li><a class="dropdown-item" href="#">Graduaciones</a></li>
                    <li><a class="dropdown-item" href="#">Día a día</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Grid de fotos -->
<section class="galeria-grid py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Estudiante">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Aula">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Estudiantes">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Actividad">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1522661067900-ab829854a57f?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Clase">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="galeria-item position-relative">
                    <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80" class="img-fluid w-100 galeria-img" alt="Graduación">
                    <a href="#" class="galeria-zoom" title="Ver imagen">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
