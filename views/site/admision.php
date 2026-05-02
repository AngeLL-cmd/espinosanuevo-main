<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Admisión';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admision-page">
<!-- Hero Admisión -->
<section class="admision-hero position-relative text-white">
    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=2400&q=80" 
        alt="Aula" class="admision-hero-img">
    <div class="admision-hero-overlay"></div>
    <div class="admision-hero-caption">
        <h1 class="admision-hero-title">Proceso de Admisión</h1>
        <h2 class="admision-hero-year">2026</h2>
        <p class="admision-hero-subtitle">Únete a la familia Espinosa</p>
        <p class="admision-hero-text">Sigue estos pasos sencillos para asegurar la vacante de tu hijo.</p>
    </div>
</section>

<!-- Sección Pasos -->
<section class="admision-pasos py-5 bg-light">
    <div class="container">
        <h2 class="text-dark-blue fw-bold text-center mb-5">Pasos</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="admision-paso text-center">
                    <div class="admision-paso-icon mb-3">
                        <i class="fas fa-user-plus fa-3x text-dark-blue"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-2">1. Solicita tu Código</h3>
                    <p class="text-muted small mb-0">Recógelo presencialmente en Secretaría.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="admision-paso text-center">
                    <div class="admision-paso-icon mb-3">
                        <i class="fas fa-dollar-sign fa-3x text-dark-blue"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-2">2. Realiza el Pago</h3>
                    <p class="text-muted small mb-0">En ventanilla del BBVA o Agentes autorizados</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="admision-paso text-center">
                    <div class="admision-paso-icon mb-3">
                        <i class="fas fa-file-check fa-3x text-dark-blue"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-2">3. Valida tu Pago</h3>
                    <p class="text-muted small mb-0">Canjea tu voucher en la Tesorería del colegio.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="admision-paso text-center">
                    <div class="admision-paso-icon mb-3">
                        <i class="fas fa-file-signature fa-3x text-dark-blue"></i>
                    </div>
                    <h3 class="fw-bold text-dark-blue mb-2">4. Formaliza la Matrícula</h3>
                    <p class="text-muted small mb-0">Entrega documentos y firma la ficha oficial.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección Requisitos -->
<section class="admision-requisitos py-5 bg-light">
    <div class="container">
        <h2 class="text-dark-blue fw-bold text-center mb-3">Requisitos</h2>
        <p class="text-muted text-center mb-5">Por favor, asegúrese de contar con todos los documentos originales y copias antes de iniciar el trámite.</p>

        <ul class="nav nav-pills admision-requisitos-tabs justify-content-center mb-4" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="inicial-tab" data-bs-toggle="pill" data-bs-target="#inicial" type="button" role="tab">INICIAL</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="primaria-tab" data-bs-toggle="pill" data-bs-target="#primaria" type="button" role="tab">PRIMARIA</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="secundaria-tab" data-bs-toggle="pill" data-bs-target="#secundaria" type="button" role="tab">SECUNDARIA</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="inicial" role="tabpanel">
                <div class="admision-requisitos-box bg-light-blue-content p-4 rounded">
                    <h4 class="fw-bold text-dark-blue mb-3">Requisitos postulante: 3, 4 y 5 Años</h4>
                    <ul class="list-unstyled mb-0 text-dark-blue">
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Ficha Única de Matrícula (Siagie).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI del estudiante (Original y Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI de los padres o apoderados (Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Cartilla de Vacunación al día.</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Examen de Tamizaje de Hemoglobina.</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Recibo de luz o agua (Domicilio actual).</li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="primaria" role="tabpanel">
                <div class="admision-requisitos-box bg-light-blue-content p-4 rounded">
                    <h4 class="fw-bold text-dark-blue mb-3">Requisitos postulante: 1ro a 6to Grado</h4>
                    <ul class="list-unstyled mb-0 text-dark-blue">
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Ficha Única de Matrícula (Siagie).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI del estudiante (Original y Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI de los padres o apoderados (Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Libreta de notas del grado anterior.</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Recibo de luz o agua (Domicilio actual).</li>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="secundaria" role="tabpanel">
                <div class="admision-requisitos-box bg-light-blue-content p-4 rounded">
                    <h4 class="fw-bold text-dark-blue mb-3">Requisitos postulante: 1ro a 5to Grado</h4>
                    <ul class="list-unstyled mb-0 text-dark-blue">
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Ficha Única de Matrícula (Siagie).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI del estudiante (Original y Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> DNI de los padres o apoderados (Copia).</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Libreta de notas del grado anterior.</li>
                        <li class="mb-2"><i class="fas fa-check text-dark-blue me-2"></i> Recibo de luz o agua (Domicilio actual).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Documentos descargables -->
<section class="admision-documentos py-5 bg-white">
    <div class="container">
        <h2 class="text-dark-blue fw-bold text-center mb-5">Documentos descargables</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <a href="#" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-3 fw-bold">
                    <i class="fas fa-file-pdf fa-lg"></i> Descargar Reglamento Interno 2026
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-3 fw-bold">
                    <i class="fas fa-file-pdf fa-lg"></i> Lista de útiles - Primaria y Secundaria
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-3 fw-bold">
                    <i class="fas fa-file-pdf fa-lg"></i> Lista de útiles - Inicial
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 py-3 fw-bold">
                    <i class="fas fa-file-pdf fa-lg"></i> Contrato de Servicios Educativos
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Sección Contacto -->
<div class="contact-section position-relative py-5 mt-5"
    style="background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;">
    <div class="overlay position-absolute w-100 h-100 top-0 start-0"
        style="background: linear-gradient(to right, rgba(29, 53, 87, 0.9), rgba(29, 53, 87, 0.6));"></div>
    <div class="container position-relative py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-white mb-5 mb-lg-0">
                <h2 class="display-5 fw-bold mb-3">Contáctanos</h2>
                <p class="lead mb-5">Escríbenos hoy mismo y asegura el futuro de tu hijo.</p>
                <div class="mb-3 d-flex align-items-center fs-5">
                    <i class="fas fa-phone me-3"></i> +51 954 357 987 / +51 1 7198343
                </div>
                <div class="mb-3 d-flex align-items-center fs-5">
                    <i class="fas fa-map-marker-alt me-3"></i> Jr. Av. Ricardo Bentín N° 570, Rímac, Lima
                </div>
                <div class="d-flex align-items-center fs-5">
                    <i class="fas fa-envelope me-3"></i> admision@colegioespinosa.edu.pe
                </div>
            </div>
            <div class="col-lg-6">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Nombre y Apellidos">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg bg-light border-0" placeholder="Correo">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control form-control-lg bg-light border-0" placeholder="Teléfono">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control form-control-lg bg-light border-0" rows="4" placeholder="Mensaje"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger btn-lg w-100 fw-bold">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
