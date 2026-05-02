<?php
/** @var yii\web\View $this */
use yii\bootstrap5\Html;

$this->title = 'Nuestro Equipo';
$this->params['breadcrumbs'][] = $this->title;

$gerencia = [
    ['img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
];

$administrativo = [
    ['img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
];

$profesorado = [
    ['img' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
    ['img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80', 'nombre' => 'Alvaro Bianco Espinosa', 'cargo' => 'Director'],
];
?>
<div class="equipo-page">

<!-- Hero Nuestro Equipo -->
<section class="equipo-hero position-relative text-white">
    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=2400&q=80" 
        alt="Biblioteca" class="equipo-hero-img">
    <div class="equipo-hero-overlay"></div>
    <div class="equipo-hero-caption">
        <h1 class="equipo-hero-title">Nuestro Equipo</h1>
    </div>
</section>

<!-- Gerencia -->
<section class="equipo-section py-5 bg-white">
    <div class="container">
        <h2 class="text-dark-blue fw-bold mb-5">Gerencia</h2>
        <div class="row g-4">
            <?php foreach ($gerencia as $item): ?>
            <div class="col-6 col-md-6 col-lg-4">
                <div class="equipo-card text-center">
                    <img src="<?= Html::encode($item['img']) ?>" alt="<?= Html::encode($item['nombre']) ?>" class="equipo-card-img">
                    <h5 class="fw-bold text-dark-blue mt-3 mb-1"><?= Html::encode($item['nombre']) ?></h5>
                    <p class="text-muted mb-0"><?= Html::encode($item['cargo']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Equipo Administrativo -->
<section class="equipo-section py-5 bg-light-blue">
    <div class="container">
        <h2 class="text-dark-blue fw-bold mb-5">Equipo Administrativo</h2>
        <div class="row g-4">
            <?php foreach ($administrativo as $item): ?>
            <div class="col-6 col-md-6 col-lg-4">
                <div class="equipo-card text-center">
                    <img src="<?= Html::encode($item['img']) ?>" alt="<?= Html::encode($item['nombre']) ?>" class="equipo-card-img">
                    <h5 class="fw-bold text-dark-blue mt-3 mb-1"><?= Html::encode($item['nombre']) ?></h5>
                    <p class="text-muted mb-0"><?= Html::encode($item['cargo']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Profesorado -->
<section class="equipo-section py-5 bg-white">
    <div class="container">
        <h2 class="text-dark-blue fw-bold mb-5">Profesorado</h2>
        <div class="row g-4">
            <?php foreach ($profesorado as $item): ?>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="equipo-card text-center">
                    <img src="<?= Html::encode($item['img']) ?>" alt="<?= Html::encode($item['nombre']) ?>" class="equipo-card-img">
                    <h5 class="fw-bold text-dark-blue mt-3 mb-1"><?= Html::encode($item['nombre']) ?></h5>
                    <p class="text-muted mb-0"><?= Html::encode($item['cargo']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</div>
