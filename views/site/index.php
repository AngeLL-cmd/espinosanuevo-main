<?php
/** @var yii\web\View $this */
$this->title = 'Institución Educativa Privada Enrique N. Espinosa';
?>

<!-- Sección Hero (Carrusel) -->
<div id="heroCarousel" class="carousel slide hero-section" data-bs-ride="carousel" data-bs-interval="12000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active" data-bs-interval="12000">
            <img src="https://picsum.photos/id/237/1600/1000" class="d-block w-100" alt="Admisión 2026">
            <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100 pb-5 top-0 bottom-0">
                <h1 class="display-3 fw-bold mb-3 animate-up ene-hero-title">Admisión 2026</h1>
                <p class="lead mb-4 fs-4 animate-up delay-100 ene-hero-subtitle">Más de 57 años de excelencia educativa en el Rímac. Inicial, Primaria y Secundaria.</p>
                <a href="#" class="btn btn-danger btn-lg fw-bold px-5 py-3 animate-up delay-200 hover-lift ene-hero-cta">Mas
                    información aquí</a>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item" data-bs-interval="12000">
            <img src="https://picsum.photos/id/26/1600/1000" class="d-block w-100" alt="Formación Integral">
            <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100 pb-5 top-0 bottom-0">
                <h1 class="display-3 fw-bold mb-3 animate-up ene-hero-title">Formación Integral</h1>
                <p class="lead mb-4 fs-4 animate-up delay-100 ene-hero-subtitle">Desarrollamos el potencial académico y humano de cada estudiante.</p>
                <a href="#" class="btn btn-warning btn-lg fw-bold px-5 py-3 animate-up delay-200 hover-lift ene-hero-cta">Conoce
                    nuestra propuesta</a>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item" data-bs-interval="12000">
            <img src="https://picsum.photos/id/180/1600/1000" class="d-block w-100" alt="Innovación Educativa">
            <div
                class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100 pb-5 top-0 bottom-0">
                <h1 class="display-3 fw-bold mb-3 animate-up ene-hero-title">Innovación Educativa</h1>
                <p class="lead mb-4 fs-4 animate-up delay-100 ene-hero-subtitle">Tecnología y metodología moderna al servicio del aprendizaje.</p>
                <a href="#" class="btn btn-primary btn-lg fw-bold px-5 py-3 animate-up delay-200 hover-lift ene-hero-cta">Visita
                    el aula virtual</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Sección de Bienvenida -->
<div class="welcome-section py-5 bg-light-blue mt-5">
    <div class="container py-5">
        <div class="row align-items-center bg-light-blue-content p-5 rounded-3">
            <div class="col-12 text-center mb-5">
                <div class="d-flex justify-content-center mb-5">
                    <div class="ene-tabs" role="tablist" aria-label="Secciones de bienvenida">
                        <a href="#" class="ene-tab is-active" role="tab" aria-selected="true">BIENVENIDA</a>
                        <a href="#" class="ene-tab" role="tab" aria-selected="false">HISTORIA</a>
                        <a href="#" class="ene-tab" role="tab" aria-selected="false">NOSOTROS</a>
                        <a href="#" class="ene-tab" role="tab" aria-selected="false">PLAN DE ESTUDIOS</a>
                    </div>
                </div>
                <h2 class="text-dark-blue fw-bold display-5 mb-4">Bienvenidos a la Familia Espinosina</h2>
            </div>
            <div class="col-lg-5 mb-4 mb-lg-0">
                <img src="https://picsum.photos/id/1005/700/900" alt="Director" class="img-fluid rounded shadow-sm">
                <p class="text-center mt-2 small fst-italic">Director "Espinosa"</p>
            </div>
            <div class="col-lg-7 ps-lg-5 text-dark-blue">
                <p class="lead fs-5" style="line-height: 1.8;">
                    Es un honor recibirlos en nuestra plataforma virtual. En el Colegio Espinosa, nuestro compromiso
                    diario es brindar una educación que combine la más alta exigencia académica con la calidez humana.
                    Trabajamos junto a ustedes para formar líderes éticos, preparados para afrontar los retos del futuro
                    con integridad y excelencia.
                </p>
                <p class="mt-5 fw-bold">Atentamente "La dirección"</p>
            </div>
        </div>
    </div>
</div>

<!-- Sección Propuesta Educativa -->
<div class="proposal-section py-5 bg-white">
    <div class="container text-center">
        <h2 class="text-dark-blue fw-bold display-5 mb-3">Propuesta educativa</h2>
        <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 800px;">Formación integral que une la exigencia
            científica con la sensibilidad humanística desde los primeros pasos.</p>

        <div class="row g-4 mb-5">
            <!-- Inicial -->
            <div class="col-md-4">
                <div class="card border-0 text-white rounded-3 overflow-hidden shadow h-100 position-relative">
                    <img src="https://picsum.photos/id/1027/900/1200" class="card-img h-100" alt="Inicial" style="object-fit: cover; min-height: 400px;">
                    <div
                        class="card-img-overlay d-flex flex-column justify-content-end bg-gradient-dark p-4 text-start">
                        <h3 class="fw-bold mb-0">INICIAL</h3>
                        <p class="mb-2">3, 4 y 5 años</p>
                        <ul class="list-unstyled small mb-0">
                            <li>• Estimulación Temprana y Psicomotricidad</li>
                            <li>• Iniciación al idioma Inglés</li>
                            <li>• Aulas seguras y didácticas</li>
                        </ul>
                    </div>
                </div>
                <a href="#"
                    class="btn btn-danger w-100 mt-3 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                    <i class="fas fa-file-pdf"></i> Propuesta Educativa (Inicial - 2026)
                </a>
            </div>

            <!-- Primaria -->
            <div class="col-md-4">
                <div class="card border-0 text-white rounded-3 overflow-hidden shadow h-100 position-relative">
                    <img src="https://picsum.photos/id/1025/900/1200" class="card-img h-100" alt="Primaria" style="object-fit: cover; min-height: 400px;">
                    <div
                        class="card-img-overlay d-flex flex-column justify-content-end bg-gradient-dark p-4 text-start">
                        <h3 class="fw-bold mb-0">PRIMARIA</h3>
                        <p class="mb-2">1ro a 6to Grado</p>
                        <ul class="list-unstyled small mb-0">
                            <li>• Inglés Intensivo y Francés básico</li>
                            <li>• Talleres de Computación y Robótica</li>
                            <li>• Formación sólida en Valores</li>
                        </ul>
                    </div>
                </div>
                <a href="#"
                    class="btn btn-danger w-100 mt-3 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                    <i class="fas fa-file-pdf"></i> Propuesta Educativa (Primaria - 2026)
                </a>
            </div>

            <!-- Secundaria -->
            <div class="col-md-4">
                <div class="card border-0 text-white rounded-3 overflow-hidden shadow h-100 position-relative">
                    <img src="https://picsum.photos/id/1062/900/1200" class="card-img h-100" alt="Secundaria" style="object-fit: cover; min-height: 400px;">
                    <div
                        class="card-img-overlay d-flex flex-column justify-content-end bg-gradient-dark p-4 text-start">
                        <h3 class="fw-bold mb-0">SECUNDARIA</h3>
                        <p class="mb-2">1ro a 5to Grado</p>
                        <ul class="list-unstyled small mb-0">
                            <li>• Preparación Pre-Universitaria</li>
                            <li>• Laboratorios de Ciencias</li>
                            <li>• Certificación en Inglés</li>
                        </ul>
                    </div>
                </div>
                <a href="#"
                    class="btn btn-danger w-100 mt-3 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                    <i class="fas fa-file-pdf"></i> Propuesta Educativa (Secundaria - 2026)
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Sección Vida Escolar -->
<section class="school-life mt-5">
    <div id="schoolLifeCarousel" class="carousel slide school-life-carousel" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 school-life-img"
                    src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=2400&q=80"
                    alt="Vida escolar 1"
                    onerror="this.style.display='none'">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 school-life-img"
                    src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=2400&q=80"
                    alt="Vida escolar 2"
                    onerror="this.style.display='none'">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 school-life-img"
                    src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?auto=format&fit=crop&w=2400&q=80"
                    alt="Vida escolar 3"
                    onerror="this.style.display='none'">
            </div>
        </div>

        <div class="school-life-overlay"></div>

        <div class="school-life-caption">
            <div class="container">
                <h2 class="school-life-title">Nuestra vida escolar</h2>
                <p class="school-life-subtitle">Momentos que nos<br>llenan de orgullo.</p>
                <a href="#" class="btn btn-warning fw-bold mt-3 px-4 py-2 school-life-cta">Ver Galería Completa</a>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Sección Noticias -->
<div class="news-section py-5 bg-light mt-5">
    <div class="container text-center py-5">
        <h2 class="text-dark-blue fw-bold display-5 mb-3">Comunicados y Noticias</h2>
        <p class="text-muted mb-5">Mantente informado de las actividades oficiales.</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="https://picsum.photos/id/1011/800/500" class="card-img-top news-img" alt="News 1">
                        <span class="badge bg-warning text-dark position-absolute bottom-0 start-0 m-3 px-3 py-2">Leer
                            mas...</span>
                    </div>
                    <div class="card-body text-start">
                        <small class="text-muted d-block mb-1">Enero 15, Carlos Arigue</small>
                        <h5 class="card-title fw-bold text-dark-blue">"Inicio del Proceso de Admisión 2026"</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="https://picsum.photos/id/1050/800/500" class="card-img-top news-img" alt="News 2">
                        <span class="badge bg-warning text-dark position-absolute bottom-0 start-0 m-3 px-3 py-2">Leer
                            mas...</span>
                    </div>
                    <div class="card-body text-start">
                        <small class="text-muted d-block mb-1">Febrero 2, Carlos Arigue</small>
                        <h5 class="card-title fw-bold text-dark-blue">"Ganadores del Concurso de Robótica Distrital"
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        <img src="https://picsum.photos/id/1060/800/500" class="card-img-top news-img" alt="News 3">
                        <span class="badge bg-warning text-dark position-absolute bottom-0 start-0 m-3 px-3 py-2">Leer
                            mas...</span>
                    </div>
                    <div class="card-body text-start">
                        <small class="text-muted d-block mb-1">Febrero 25, Carlos Arigue</small>
                        <h5 class="card-title fw-bold text-dark-blue">"Rol de Exámenes Mensuales - Marzo"</h5>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-warning fw-bold mt-5 px-5 py-3 shadow-sm">Ver Todas las Noticias</a>
    </div>
</div>

<!-- Sección Contacto -->
<div class="contact-section position-relative py-5 mt-5"
    style="background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;">
    <div class="overlay position-absolute w-100 h-100 top-0 start-0"
        style="background: linear-gradient(to right, rgba(29, 53, 87, 0.9), rgba(29, 53, 87, 0.6));"></div>
    <div class="container position-relative z-index-1 py-5">
        <div class="row">
            <div class="col-lg-6 text-white mb-5 mb-lg-0">
                <h2 class="display-4 fw-bold mb-3">Contáctanos</h2>
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
                        <input type="text" class="form-control form-control-lg bg-light opacity-75 border-0"
                            placeholder="Nombre y Apellidos">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg bg-light opacity-75 border-0"
                            placeholder="Correo">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control form-control-lg bg-light opacity-75 border-0"
                            placeholder="Teléfono">
                    </div>
                    <div class="mb-4">
                        <textarea class="form-control form-control-lg bg-light opacity-75 border-0" rows="4"
                            placeholder="Mensaje"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger btn-lg w-100 fw-bold">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>