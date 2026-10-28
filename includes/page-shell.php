<?php
/**
 * Page shell helper — bootstraps PHP, loads all data files,
 * and exposes common page-rendering helpers.
 *
 * Usage:
 *   require_once __DIR__ . '/includes/page-shell.php';
 *   page_header([...]);
 *   ... page body ...
 *   page_footer();
 */

declare(strict_types=1);

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/seo.php';

// Load all data files
foreach (glob(__DIR__ . '/../data/*.php') as $dataFile) {
    require_once $dataFile;
}

// Make key data globally accessible
global $BUSINESS, $MODELS, $AREAS, $INTERESTS, $POWERTRAIN_LABEL,
       $POPULAR_SEARCHES, $GALLERY, $GALLERY_UNITS, $SEO_TAGS,
       $PRICE_DISCLAIMER, $INDEPENDENCE_DISCLAIMER,
       $ARTICLES, $GLOSSARY, $GLOSSARY_CATEGORIES,
       $PROMO_PROGRAMS, $PROMO_MODELS, $PROMO_DISCLAIMER,
       $COMPARES, $faqData, $SEO_KEYWORDS, $SEO_CORE_KEYWORDS,
       $SEO_KEYWORD_COUNT, $KEYWORD_CLUSTERS,
       $ALL_LANDING_PAGES, $MODEL_DETAILS,
       $GUGUN, $LUTFI, $ORGS, $SANTRI_ANGON,
       $DESIGN_CREDIT, $MANAGEMENT_CREDIT, $TEAM_CREDIT, $CREDIT_LINE, $BRAND_KEYWORDS;

bootstrap();

/**
 * Render the page header with optional SEO overrides.
 *
 * @param array $opts {
 *   active: string       — active nav key (e.g. 'harga', 'artikel')
 *   title: string        — page title
 *   description: string  — meta description
 *   canonical: string    — canonical URL (defaults to current URL)
 *   ogImage: string      — OG image URL
 *   keywords: array      — extra keywords
 *   type: string         — 'website' or 'article'
 *   publishedTime: string — ISO date for articles
 *   jsonLd: array        — extra JSON-LD schemas to render
 *   defaultSchema: bool   — render default AutoDealer/WebSite/FAQ schema (default true)
 * }
 */
function page_header(array $opts = []): void
{
    global $page_title, $page_description, $page_canonical, $page_og_image,
           $page_keywords, $page_type, $page_published_time, $page_jsonld, $page_default_schema, $active;

    $lang = current_lang();
    $page_title = $opts['title'] ?? null;
    $page_description = $opts['description'] ?? 'Konsultan penjualan Geely untuk Bogor & Jabodetabek. Test drive, harga transparan, simulasi kredit, dan trade-in via WhatsApp.';
    $page_canonical = $opts['canonical'] ?? (SITE_URL . parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
    $page_og_image = $opts['ogImage'] ?? null;
    $page_keywords = $opts['keywords'] ?? null;
    $page_type = $opts['type'] ?? 'website';
    $page_published_time = $opts['publishedTime'] ?? null;
    $page_jsonld = $opts['jsonLd'] ?? [];
    $page_default_schema = $opts['defaultSchema'] ?? true;
    $active = $opts['active'] ?? '';

    require __DIR__ . '/header.php';
}

/**
 * Render the page footer.
 */
function page_footer(bool $showCTA = true): void
{
    global $showCTAInFooter;
    $showCTAInFooter = $showCTA;
    require __DIR__ . '/footer.php';
}

/**
 * Helper: render a section eyebrow + title + subtitle block.
 */
function render_section_header(string $eyebrow, string $title, ?string $subtitle = null, bool $centered = true): void
{
    $align = $centered ? 'text-center' : 'text-left';
    echo '<div class="' . $align . '" style="max-width:42rem;' . ($centered ? ' margin-inline:auto;' : '') . '">';
    echo '<span class="section-eyebrow">' . e($eyebrow) . '</span>';
    echo '<h2 class="section-title">' . e($title) . '</h2>';
    if ($subtitle) echo '<p class="section-subtitle">' . e($subtitle) . '</p>';
    echo '</div>';
}

/**
 * Helper: render breadcrumbs.
 */
function render_breadcrumbs(array $crumbs): void
{
    echo '<nav aria-label="Breadcrumb"><ol class="breadcrumbs">';
    foreach ($crumbs as $i => $c) {
        $isLast = $i === array_key_last($crumbs);
        echo '<li>';
        if (!$isLast) echo '<a href="' . e($c['url']) . '">' . e($c['name']) . '</a>';
        else echo '<span>' . e($c['name']) . '</span>';
        echo '</li>';
    }
    echo '</ol></nav>';
}

/**
 * Helper: render a model card.
 */
function render_model_card(array $model): void
{
    $lang = current_lang();
    $powertrainLabel = $GLOBALS['POWERTRAIN_LABEL'][$model['powertrain']] ?? ['id' => '', 'en' => ''];
    echo '<a href="/model/' . e($model['id']) . '" class="model-card" style="text-decoration:none;">';
    echo '<div class="model-card-image">';
    echo '<img src="' . e($model['image']) . '" alt="' . e($model['name']) . '" loading="lazy">';
    if (!empty($model['badge'])) {
        echo '<span class="badge badge-primary" style="position:absolute; top:0.75rem; left:0.75rem;">' . e($model['badge'][$lang]) . '</span>';
    }
    if (!empty($model['illustrative'])) {
        echo '<span class="badge badge-warning" style="position:absolute; top:0.75rem; right:0.75rem;">' . e(t('models', 'illustrative')) . '</span>';
    }
    echo '</div>';
    echo '<div class="model-card-body">';
    echo '<div style="display:flex; align-items:baseline; justify-content:space-between; gap:0.5rem;">';
    echo '<h3 class="model-card-name">' . e($model['name']) . '</h3>';
    echo '<span class="badge badge-outline">' . e($powertrainLabel[$lang]) . '</span>';
    echo '</div>';
    echo '<p class="model-card-blurb">' . e($model['blurb'][$lang]) . '</p>';
    echo '<ul class="model-card-specs">';
    foreach ($model['specs'] as $spec) {
        echo '<li>' . e($spec[$lang]) . '</li>';
    }
    echo '</ul>';
    if (!empty($model['colors'])) {
        echo '<div class="color-swatches">';
        foreach ($model['colors'] as $color) {
            echo '<span class="color-swatch" style="background:' . e($color['swatch']) . ';" title="' . e($color['label'][$lang]) . '"></span>';
        }
        echo '</div>';
    }
    echo '<div class="model-card-footer">';
    echo '<div class="model-card-price">' . e(t('models', 'from')) . '<span class="model-card-price-value">' . format_juta($model['priceFrom']) . '</span></div>';
    echo '<span class="btn btn-ghost btn-sm">' . e(t('models', 'viewDetail')) . ' →</span>';
    echo '</div>';
    echo '</div>';
    echo '</a>';
}

/**
 * Helper: render a service card.
 */
function render_service_card(string $icon, string $title, string $desc): void
{
    echo '<div class="service-card">';
    echo '<span class="service-icon">' . $icon . '</span>';
    echo '<h3 class="service-title">' . e($title) . '</h3>';
    echo '<p class="service-desc">' . e($desc) . '</p>';
    echo '</div>';
}
