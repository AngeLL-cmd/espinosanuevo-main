# Documentación del Proyecto - Colegio Enrique N. Espinosa

## Índice
1. [Resumen del proyecto](#resumen-del-proyecto)
2. [Estructura de archivos modificados/creados](#estructura-de-archivos)
3. [Páginas implementadas](#páginas-implementadas)
4. [Cambios por archivo](#cambios-por-archivo)
5. [Rutas y URLs](#rutas-y-urls)
6. [Cómo ejecutar el proyecto](#cómo-ejecutar-el-proyecto)
7. [Personalización de contenido](#personalización-de-contenido)

---

## Resumen del proyecto

Sitio web institucional para la **Institución Educativa Privada Enrique N. Espinosa**, desarrollado con **Yii2** y **Bootstrap 5**. El diseño replica las capturas de Figma proporcionadas, con header, footer, carruseles, secciones de contenido y páginas internas.

---

## Estructura de archivos

```
espinosanuevo-main/
├── config/
│   └── web.php                    # Config: rutas, assetManager
├── controllers/
│   └── SiteController.php         # Nuevas acciones: admision, galeria, noticias, revista, equipo
├── views/
│   ├── layouts/
│   │   └── main.php               # Layout: header, footer, menú
│   └── site/
│       ├── index.php              # Home (hero, bienvenida, propuesta, vida escolar, noticias, contacto)
│       ├── admision.php           # Página Admisión
│       ├── galeria.php            # Página Galería de fotos
│       ├── noticias.php           # Página Noticias
│       ├── revista.php            # Página Revista
│       └── equipo.php             # Página Nuestro Equipo
└── web/
    └── css/
        └── site.css               # Estilos globales y específicos por página
```

---

## Páginas implementadas

### 1. Home (`/` o `/site/index`)
- **Hero (carrusel)**: 3 slides (Admisión 2026, Formación Integral, Innovación Educativa) con imágenes por URL
- **Sección Bienvenida**: Tabs (Bienvenida, Historia, Nosotros, Plan de Estudios), texto y foto del director
- **Propuesta Educativa**: 3 cards (Inicial, Primaria, Secundaria) con botones de descarga
- **Nuestra vida escolar**: Carrusel con overlay y texto "Momentos que nos llenan de orgullo"
- **Comunicados y Noticias**: 3 cards de noticias + botón "Ver Todas las Noticias"
- **Contacto**: Formulario + datos de contacto con imagen de fondo

### 2. Admisión (`/admision`)
- Hero "Proceso de Admisión 2026"
- **Pasos**: 4 pasos con iconos (Solicita tu Código, Realiza el Pago, Valida tu Pago, Formaliza la Matrícula)
- **Requisitos**: Tabs INICIAL / PRIMARIA / SECUNDARIA con listas de documentos
- **Documentos descargables**: 4 botones rojos (Reglamento Interno, Lista de útiles, Contrato)
- **Contacto**: Formulario con overlay

### 3. Galería (`/galeria`)
- Hero "Galería de fotos"
- **Filtros**: Año, Mes, Categoría (dropdowns)
- **Grid de imágenes**: 6 fotos con icono de zoom amarillo en esquina

### 4. Noticias (`/noticias`)
- Hero "Noticias"
- **Filtros**: Año, Mes
- **Grid de noticias**: 9 tarjetas con imagen, badge "Leer mas...", fecha/autor y título

### 5. Revista (`/revista`)
- Hero "Revista"
- **Filtros**: Año, Mes
- **Bloques de portadas**: 2 recuadros para portadas de revista

### 6. Nuestro Equipo (`/equipo`)
- Hero "Nuestro Equipo"
- **Gerencia**: 3 tarjetas (imagen + nombre + cargo)
- **Equipo Administrativo**: 6 tarjetas en 2 columnas, fondo azul claro
- **Profesorado**: 2 tarjetas en azul claro + 4 en blanco

---

## Cambios por archivo

### `config/web.php`
- **assetManager**: `appendTimestamp => true` para evitar caché de CSS/JS
- **urlManager.rules**: Reglas para URLs amigables:
  - `admision` → `site/admision`
  - `galeria` → `site/galeria`
  - `noticias` → `site/noticias`
  - `revista` → `site/revista`
  - `equipo` → `site/equipo`

### `controllers/SiteController.php`
- `actionAdmision()`: Renderiza `admision.php`
- `actionGaleria()`: Renderiza `galeria.php`
- `actionNoticias()`: Renderiza `noticias.php`
- `actionRevista()`: Renderiza `revista.php`
- `actionEquipo()`: Renderiza `equipo.php`

### `views/layouts/main.php`
- **Header**: Logo, menú (Inicio, Admisión, Media dropdown), botones Aula virtual e Intranet
- **Media dropdown**: Galería, Revista, Videos
- **Footer**: Logo, redes sociales, enlaces (Menú, Home, Descargables)
- **Enlaces actualizados**: Admisión → `/admision`, Galería → `/galeria`, Nosotros → `/equipo`, Comunicados y Noticias → `/noticias`

### `views/site/index.php`
- Hero carrusel con 3 slides (imágenes por URL)
- Tabs de bienvenida con clase `.ene-tabs`
- Sección vida escolar como carrusel (`#schoolLifeCarousel`)
- Sin caja gris en slides 2 y 3 del hero

### `web/css/site.css`
**Colores y globales:**
- `.bg-custom-blue` (#1a2b4b)
- `.text-dark-blue`
- `.bg-light-blue`, `.bg-light-blue-content`

**Header:**
- `.ene-btn-virtual`, `.ene-btn-intranet`

**Hero principal:**
- Altura 520px (420px móvil)

**Tabs bienvenida:**
- `.ene-tabs`, `.ene-tab`, `.ene-tab.is-active`

**Vida escolar (carrusel):**
- `.school-life-carousel`, `.school-life-img`, `.school-life-overlay`, `.school-life-caption`, altura 360px

**Admisión:**
- `.admision-hero`, `.admision-pasos`, `.admision-requisitos-tabs`

**Galería:**
- `.galeria-hero`, `.galeria-filtro-btn`, `.galeria-item`, `.galeria-zoom`

**Noticias:**
- `.noticias-hero`, `.noticias-filtro-btn`, `.noticias-card-badge`

**Revista:**
- `.revista-hero`, `.revista-filtro-btn`, `.revista-portada`

**Equipo:**
- `.equipo-hero`, `.equipo-card`, `.equipo-card-img`

---

## Rutas y URLs

| Página          | URL                              |
|-----------------|----------------------------------|
| Home            | `/` o `/site/index`             |
| Admisión        | `/admision`                     |
| Galería         | `/galeria`                     |
| Noticias        | `/noticias`                    |
| Revista         | `/revista`                     |
| Nuestro Equipo  | `/equipo`                      |

**URL base local:**
```
http://localhost/espinosanuevo-main/espinosanuevo-main/web
```

---

## Cómo ejecutar el proyecto

1. **Requisitos**: XAMPP (Apache + PHP + MySQL), Composer
2. **Instalación**:
   ```bash
   cd c:\xampp\htdocs\espinosanuevo-main\espinosanuevo-main
   composer install
   ```
3. **Iniciar**: Abrir Apache en XAMPP y acceder a:
   ```
   http://localhost/espinosanuevo-main/espinosanuevo-main/web
   ```

---

## Personalización de contenido

### Imágenes del Hero (Home)
En `views/site/index.php` líneas ~17–42, cambiar los `src` de los `<img>`:
```php
src="https://images.unsplash.com/..."  // Reemplazar por tu URL o:
src="<?= Yii::getAlias('@web') ?>/img/hero-1.jpg"
```

### Imágenes "Nuestra vida escolar"
En `views/site/index.php`, buscar `#schoolLifeCarousel` y actualizar los `src` de las 3 imágenes.

### Imágenes de la Galería
En `views/site/galeria.php`, sección "Grid de fotos", cambiar los `src` de cada `<img>`.

### Noticias
En `views/site/noticias.php`, editar el array `$noticias` con fecha, autor, título e imagen real.

### Equipo (Gerencia, Administrativo, Profesorado)
En `views/site/equipo.php`, editar los arrays `$gerencia`, `$administrativo` y `$profesorado` con nombres, cargos e imágenes reales.

### Documentos descargables (Admisión)
En `views/site/admision.php`, actualizar los `href="#"` de los botones por las URLs o rutas de los PDF.

---

