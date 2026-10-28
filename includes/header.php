<?php
/**
 * Site header — sticky nav with brand, desktop nav, mobile drawer,
 * language toggle, theme toggle, and WhatsApp CTA.
 *
 * @param string $active  Current nav key (for active state)
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/i18n.php';

$lang = current_lang();
$brandMarkSvg = '<svg viewBox="0 0 48 48" fill="none" aria-hidden="true" class="brand-mark">
  <path d="M24 3 43 13.5v21L24 45 5 34.5v-21L24 3Z" stroke="#1aa37e" stroke-width="2.6" stroke-linejoin="round"/>
  <path d="M31.5 19.2c-1.6-2.4-4.3-3.9-7.4-3.9-5 0-9 3.9-9 8.7s4 8.7 9 8.7c4.2 0 7.7-2.8 8.7-6.6h-8.2" stroke="currentColor" stroke-width="2.6" stroke-linejoin="round" stroke-linecap="round" fill="none"/>
</svg>';

// Nav items — top-level menu
$navItems = [
    ['key' => 'models', 'label' => t('nav', 'models'), 'href' => '/#model'],
    ['key' => 'harga', 'label' => t('nav', 'harga'), 'href' => '/harga-mobil-geely-bogor'],
    ['key' => 'promo', 'label' => t('nav', 'promo'), 'href' => '/promo-geely-bogor'],
    ['key' => 'artikel', 'label' => t('nav', 'artikel'), 'href' => '/artikel'],
    ['key' => 'compare', 'label' => t('nav', 'compare'), 'href' => '/vs'],
    ['key' => 'glosarium', 'label' => t('nav', 'glosarium'), 'href' => '/glosarium'],
    ['key' => 'faq', 'label' => t('nav', 'faq'), 'href' => '/#faq'],
    ['key' => 'about', 'label' => t('nav', 'about'), 'href' => '/tentang'],
];

// Mobile drawer items (more comprehensive)
$drawerItems = [
    ['label' => t('nav', 'models'), 'href' => '/#model'],
    ['label' => t('nav', 'harga') . ' & Varian', 'href' => '/harga-mobil-geely-bogor'],
    ['label' => t('nav', 'promo'), 'href' => '/promo-geely-bogor'],
    ['label' => t('nav', 'simulator'), 'href' => '/#financing'],
    ['label' => t('nav', 'testDrive'), 'href' => '/#test-drive'],
    ['label' => t('nav', 'artikel'), 'href' => '/artikel'],
    ['label' => t('nav', 'glosarium'), 'href' => '/glosarium'],
    ['label' => t('nav', 'compare'), 'href' => '/vs'],
    ['label' => t('nav', 'keywords'), 'href' => '/indeks-kata-kunci'],
    ['label' => t('nav', 'gallery'), 'href' => '/#galeri'],
    ['label' => t('nav', 'about'), 'href' => '/tentang'],
    ['label' => t('nav', 'contact'), 'href' => '/#kontak'],
];

$waLink = wa_link('Halo Pusat Geely, saya ingin bertanya tentang mobil Geely.');
?>
<!DOCTYPE html>
<html lang="<?= e($lang) ?>" data-scroll-behavior="smooth"<?= GA_ID ? ' data-ga-id="' . e(GA_ID) . '"' : '' ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0c1210">
    <title><?= e($page_title ?? SITE_NAME . ' — ' . BUSINESS['region_id']) ?></title>
    <meta name="description" content="<?= e($page_description ?? 'Konsultan penjualan Geely untuk Bogor & Jabodetabek. Test drive, harga transparan, simulasi kredit, dan trade-in via WhatsApp.') ?>">
    <?php if (!empty($page_keywords)): ?>
    <meta name="keywords" content="<?= e(implode(', ', $page_keywords)) ?>">
    <?php endif; ?>
    <meta name="author" content="<?= e(BUSINESS['pic']) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?= e($page_canonical ?? (SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/'))) ?>">
    <link rel="alternate" hreflang="id-ID" href="<?= e($page_canonical ?? (SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/'))) ?>">
    <link rel="alternate" hreflang="en" href="<?= e(($page_canonical ?? (SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/'))) . (str_contains($_SERVER['REQUEST_URI'] ?? '/', '?') ? '&' : '?') . 'lang=en') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= e($page_canonical ?? SITE_URL) ?>">
    <link rel="alternate" type="application/rss+xml" title="<?= e(SITE_NAME) ?> — Feed" href="<?= e(SITE_URL . '/feed.xml') ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="<?= e($page_type ?? 'website') ?>">
    <meta property="og:locale" content="<?= $lang === 'en' ? 'en_US' : 'id_ID' ?>">
    <meta property="og:alternate_locale" content="<?= $lang === 'en' ? 'id_ID' : 'en_US' ?>">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:url" content="<?= e($page_canonical ?? (SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/'))) ?>">
    <meta property="og:title" content="<?= e($page_title ?? SITE_NAME) ?>">
    <meta property="og:description" content="<?= e($page_description ?? '') ?>">
    <meta property="og:image" content="<?= e($page_og_image ?? (SITE_URL . '/assets/images/hero.webp')) ?>">
    <meta property="og:image:width" content="1440">
    <meta property="og:image:height" content="720">
    <?php if (!empty($page_published_time)): ?>
    <meta property="article:published_time" content="<?= e($page_published_time) ?>">
    <?php endif; ?>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?= e(BUSINESS['x_handle']) ?>">
    <meta name="twitter:creator" content="<?= e(BUSINESS['x_handle']) ?>">
    <meta name="twitter:title" content="<?= e($page_title ?? SITE_NAME) ?>">
    <meta name="twitter:description" content="<?= e($page_description ?? '') ?>">
    <meta name="twitter:image" content="<?= e($page_og_image ?? (SITE_URL . '/assets/images/hero.webp')) ?>">

    <!-- Search Console verification -->
    <?php if (GOOGLE_VERIFICATION): ?><meta name="google-site-verification" content="<?= e(GOOGLE_VERIFICATION) ?>"><?php endif; ?>
    <?php if (BING_VERIFICATION): ?><meta name="msvalidate.01" content="<?= e(BING_VERIFICATION) ?>"><?php endif; ?>
    <?php if (YANDEX_VERIFICATION): ?><meta name="y-verification" content="<?= e(YANDEX_VERIFICATION) ?>"><?php endif; ?>

    <!-- Icons -->
    <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">
    <link rel="apple-touch-icon" href="/assets/images/hero.webp">
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">

    <!-- JSON-LD -->
    <?php if (!empty($page_jsonld)): foreach ($page_jsonld as $schema): ?>
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endforeach; endif; ?>

    <?php if (!empty($page_default_schema)) require_once __DIR__ . '/seo.php'; render_default_jsonld($page_jsonld ?? []); ?>

    <!-- Preload hero image -->
    <link rel="preload" as="image" href="/assets/images/hero.webp">
</head>
<body>
    <div class="scroll-progress" data-scroll-progress></div>

    <!-- ══ Header ══ -->
    <header class="site-header">
        <div class="container">
            <a href="/" class="brand" aria-label="Pusat Geely">
                <?= $brandMarkSvg ?>
                <span>PUSAT<span class="brand-name-primary">GEELY</span></span>
            </a>

            <nav class="nav-desktop" aria-label="<?= e(t('nav', 'menu')) ?>">
                <?php foreach ($navItems as $item): ?>
                <a href="<?= e($item['href']) ?>" class="nav-link<?= ($active ?? '') === $item['key'] ? ' active' : '' ?>"><?= e($item['label']) ?></a>
                <?php endforeach; ?>
            </nav>

            <div class="header-actions">
                <button type="button" class="menu-toggle" data-theme-toggle aria-label="Toggle theme" title="Toggle theme">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <circle cx="12" cy="12" r="4"/>
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                    </svg>
                </button>
                <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-sm hidden-mobile" aria-label="WhatsApp">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span class="hidden-mobile">WhatsApp</span>
                </a>
                <button type="button" class="menu-toggle" data-menu-toggle aria-label="<?= e(t('nav', 'menu')) ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                        <line x1="4" y1="6" x2="20" y2="6"/>
                        <line x1="4" y1="12" x2="20" y2="12"/>
                        <line x1="4" y1="18" x2="20" y2="18"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile drawer -->
    <div class="drawer-backdrop" data-drawer-backdrop></div>
    <aside class="drawer" data-drawer aria-label="<?= e(t('nav', 'menu')) ?>">
        <button type="button" class="drawer-close" data-menu-toggle aria-label="Close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <div style="display:flex; align-items:center; gap:0.625rem; padding-block:1rem;">
            <?= $brandMarkSvg ?>
            <span class="font-display font-bold" style="font-size:1.125rem;">PUSAT<span class="brand-name-primary">GEELY</span></span>
        </div>
        <nav class="drawer-nav">
            <?php foreach ($drawerItems as $item): ?>
            <a href="<?= e($item['href']) ?>" class="nav-link"><?= e($item['label']) ?></a>
            <?php endforeach; ?>
        </nav>
        <div style="margin-top:1.5rem; padding-top:1.5rem; border-top:1px solid var(--border); display:flex; flex-direction:column; gap:0.625rem;">
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="width:100%;">
                Chat WhatsApp
            </a>
            <button type="button" class="btn btn-outline" data-lang-toggle data-lang-target="<?= $lang === 'id' ? 'en' : 'id' ?>">
                <?= $lang === 'id' ? 'Switch to English' : 'Ganti ke Bahasa Indonesia' ?>
            </button>
        </div>
    </aside>

    <div class="scroll-progress" data-scroll-progress></div>
