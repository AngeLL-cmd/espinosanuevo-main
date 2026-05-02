<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Revista';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="revista-page">
<!-- Hero Revista -->
<section class="revista-hero position-relative text-white">
    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=2400&q=80" 
        alt="Biblioteca" class="revista-hero-img">
    <div class="revista-hero-overlay"></div>
    <div class="revista-hero-caption">
        <h1 class="revista-hero-title">Revista</h1>
    </div>
</section>

<!-- Filtros -->
<section class="revista-filtros py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <div class="dropdown">
                <button class="btn revista-filtro-btn revista-filtro-activo dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Año
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">2026</a></li>
                    <li><a class="dropdown-item" href="#">2025</a></li>
                    <li><a class="dropdown-item" href="#">2024</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn revista-filtro-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
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

<!-- Contenido / Portadas -->
<section class="revista-content py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="revista-portada">
                    <a href="#" class="d-block">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=600&q=80" alt="Revista 1" class="img-fluid w-100">
                    </a>
                    <p class="text-center mt-3 text-dark-blue fw-semibold mb-0">Revista - Enero 2026</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="revista-portada">
                    <a href="#" class="d-block">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80" alt="Revista 2" class="img-fluid w-100">
                    </a>
                    <p class="text-center mt-3 text-dark-blue fw-semibold mb-0">Revista - Febrero 2026</p>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
