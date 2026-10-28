<?php
/**
 * SEO helpers — meta tags, Open Graph, Twitter Cards, JSON-LD schema.
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/../data/site.php';
require_once __DIR__ . '/../data/branding.php';
require_once __DIR__ . '/../data/faq.php';
require_once __DIR__ . '/../data/seo-keywords.php';

/**
 * Render full <head> with SEO meta tags.
 *
 * @param array $args {
 *   title: string, description: string, canonical: string,
 *   ogImage: string (path atau URL), keywords: array,
 *   type: 'website'|'article', publishedTime: ISO date,
 *   jsonLd: array (extra JSON-LD schema)
 * }
 */
function render_head(array $args = []): void
{
    $lang = current_lang();
    $title = $args['title'] ?? (SITE_NAME . ' — ' . (current_lang() === 'en' ? BUSINESS['region_en'] : BUSINESS['region_id']));
    $description = $args['description'] ?? 'Konsultan penjualan Geely untuk Bogor & Jabodetabek. Test drive, harga transparan, simulasi kredit, dan trade-in via WhatsApp.';
    $canonical = $args['canonical'] ?? (SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/'));
    $ogImage = $args['ogImage'] ?? (SITE_URL . '/assets/images/hero.webp');
    if (!preg_match('#^https?://#', $ogImage)) $ogImage = SITE_URL . '/' . ltrim($ogImage, '/');
    $keywords = $args['keywords'] ?? SEO_CORE_KEYWORDS;
    $type = $args['type'] ?? 'website';
    $publishedTime = $args['publishedTime'] ?? null;
    $extraJsonLd = $args['jsonLd'] ?? [];

    $pageTitle = $title;
    if (!str_contains($title, SITE_NAME)) {
        $pageTitle = $title . ' | ' . SITE_NAME;
    }

    // Build keywords string
    global $SEO_TAGS, $BRAND_KEYWORDS;
    $kw = array_unique(array_merge(
        is_array($keywords) ? $keywords : [],
        $SEO_TAGS ?? [],
        $BRAND_KEYWORDS ?? []
    ));

    // Output
    echo '<!DOCTYPE html>' . "\n";
    echo '<html lang="' . e($lang) . '" data-scroll-behavior="smooth"' . (GA_ID ? ' data-ga-id="' . e(GA_ID) . '"' : '') . '>' . "\n";
    echo '<head>' . "\n";
    echo '  <meta charset="UTF-8">' . "\n";
    echo '  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">' . "\n";
    echo '  <meta name="theme-color" content="#0c1210">' . "\n";
    echo '  <title>' . e($pageTitle) . '</title>' . "\n";
    echo '  <meta name="description" content="' . e($description) . '">' . "\n";
    echo '  <meta name="keywords" content="' . e(implode(', ', array_slice($kw, 0, 30))) . '">' . "\n";
    echo '  <meta name="author" content="' . e(BUSINESS['pic']) . '">' . "\n";
    echo '  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    echo '  <link rel="canonical" href="' . e($canonical) . '">' . "\n";

    // hreflang
    echo '  <link rel="alternate" hreflang="id-ID" href="' . e($canonical) . '">' . "\n";
    echo '  <link rel="alternate" hreflang="en" href="' . e($canonical . (str_contains($canonical, '?') ? '&' : '?') . 'lang=en') . '">' . "\n";
    echo '  <link rel="alternate" hreflang="x-default" href="' . e($canonical) . '">' . "\n";

    // RSS auto-discovery
    echo '  <link rel="alternate" type="application/rss+xml" title="' . e(SITE_NAME) . ' — Feed" href="' . e(SITE_URL . '/feed.xml') . '">' . "\n";

    // Open Graph
    echo '  <meta property="og:type" content="' . e($type) . '">' . "\n";
    echo '  <meta property="og:locale" content="' . ($lang === 'en' ? 'en_US' : 'id_ID') . '">' . "\n";
    echo '  <meta property="og:alternate_locale" content="' . ($lang === 'en' ? 'id_ID' : 'en_US') . '">' . "\n";
    echo '  <meta property="og:site_name" content="' . e(SITE_NAME) . '">' . "\n";
    echo '  <meta property="og:url" content="' . e($canonical) . '">' . "\n";
    echo '  <meta property="og:title" content="' . e($title) . '">' . "\n";
    echo '  <meta property="og:description" content="' . e($description) . '">' . "\n";
    echo '  <meta property="og:image" content="' . e($ogImage) . '">' . "\n";
    echo '  <meta property="og:image:width" content="1440">' . "\n";
    echo '  <meta property="og:image:height" content="720">' . "\n";

    // Twitter
    echo '  <meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '  <meta name="twitter:site" content="' . e(BUSINESS['x_handle']) . '">' . "\n";
    echo '  <meta name="twitter:creator" content="' . e(BUSINESS['x_handle']) . '">' . "\n";
    echo '  <meta name="twitter:title" content="' . e($title) . '">' . "\n";
    echo '  <meta name="twitter:description" content="' . e($description) . '">' . "\n";
    echo '  <meta name="twitter:image" content="' . e($ogImage) . '">' . "\n";

    // Article-specific
    if ($publishedTime) {
        echo '  <meta property="article:published_time" content="' . e($publishedTime) . '">' . "\n";
    }

    // Search Console verification
    if (GOOGLE_VERIFICATION) echo '  <meta name="google-site-verification" content="' . e(GOOGLE_VERIFICATION) . '">' . "\n";
    if (BING_VERIFICATION) echo '  <meta name="msvalidate.01" content="' . e(BING_VERIFICATION) . '">' . "\n";
    if (YANDEX_VERIFICATION) echo '  <meta name="y-verification" content="' . e(YANDEX_VERIFICATION) . '">' . "\n";

    // Icons & manifest
    echo '  <link rel="icon" type="image/svg+xml" href="/assets/logo.svg">' . "\n";
    echo '  <link rel="apple-touch-icon" href="/assets/images/hero.webp">' . "\n";
    echo '  <link rel="manifest" href="/manifest.json">' . "\n";

    // Fonts — Inter + Space Grotesk
    echo '  <link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">' . "\n";

    // Stylesheet
    echo '  <link rel="stylesheet" href="/assets/css/style.css?v=' . filemtime(__DIR__ . '/../assets/css/style.css') . '">' . "\n";

    // JSON-LD: AutoDealer + WebSite + FAQPage (default)
    echo render_default_jsonld($extraJsonLd);
}

/**
 * Render the global JSON-LD schema (AutoDealer, WebSite, FAQPage, Organizations).
 */
function render_default_jsonld(array $extra = []): string
{
    global $MODELS, $SEO_TAGS, $SEO_CORE_KEYWORDS, $SEO_KEYWORD_COUNT, $faqData, $GUGUN, $LUTFI, $ORGS, $SANTRI_ANGON;

    $priceMin = min(array_map(fn($m) => $m['priceFrom'], $MODELS));
    $priceMax = max(array_map(fn($m) => $m['priceFrom'], $MODELS));

    $autoDealer = [
        '@context' => 'https://schema.org',
        '@type' => 'AutoDealer',
        '@id' => SITE_URL . '/#business',
        'name' => BUSINESS['name'],
        'description' => 'Pusat Geely adalah layanan konsultan penjualan independen untuk kendaraan Geely di Bogor & Jabodetabek. Kami bukan bagian dari, dan tidak berafiliasi dengan, PT Geely Mobil Indonesia maupun Geely Holding.',
        'url' => SITE_URL,
        'image' => SITE_URL . '/assets/images/hero.webp',
        'telephone' => '+' . BUSINESS['wa_number'],
        'email' => BUSINESS['email'],
        'priceRange' => format_idr($priceMin) . ' – ' . format_idr($priceMax),
        'keywords' => implode(', ', array_merge(
            $SEO_TAGS,
            array_slice($SEO_CORE_KEYWORDS, 0, 20),
            ['indeks ' . $SEO_KEYWORD_COUNT . ' kata kunci geely']
        )),
        'founder' => [
            '@type' => 'Person',
            'name' => BUSINESS['pic'],
            'jobTitle' => BUSINESS['role_id'],
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Bogor',
            'addressRegion' => 'Jawa Barat',
            'addressCountry' => 'ID',
        ],
        'areaServed' => array_map(fn($n) => ['@type' => 'City', 'name' => $n], ['Bogor', 'Kabupaten Bogor', 'Depok', 'Jakarta', 'Tangerang', 'Bekasi', 'Jabodetabek']),
        'openingHours' => 'Mo-Su 08:00-20:00',
        'sameAs' => [BUSINESS['instagram_url'], BUSINESS['facebook_url'], BUSINESS['tiktok_url'], BUSINESS['x_url']],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'sales',
            'telephone' => '+' . BUSINESS['wa_number'],
            'email' => BUSINESS['email'],
            'areaServed' => 'ID',
            'availableLanguage' => ['id', 'en'],
        ],
        'slogan' => BUSINESS['tagline_id'] ?? 'Partner pembelian Geely Anda di Bogor & Jabodetabek',
        'knowsAbout' => ['Geely EX5', 'Geely EX2', 'Geely Starray EM-i', 'Geely Coolray', 'mobil listrik Indonesia', 'SUV hybrid Indonesia', 'kredit mobil Geely', 'trade-in mobil Bekasi', 'test drive Jabodetabek'],
    ];

    $faqItems = array_map(fn($f) => [
        '@type' => 'Question',
        'name' => $f['q']['id'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']['id']],
    ], $faqData);

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqItems,
    ];

    $website = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => SITE_URL . '/#website',
        'url' => SITE_URL,
        'name' => BUSINESS['name'],
        'inLanguage' => 'id-ID',
        'publisher' => ['@id' => SITE_URL . '/#business'],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => SITE_URL . '/indeks-kata-kunci?q={search_term_string}',
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $schemas = [$autoDealer, $faqSchema, $website];

    // Add extra schemas (breadcrumbs, articles, etc.)
    foreach ($extra as $schema) {
        if (is_array($schema)) $schemas[] = $schema;
    }

    $out = '';
    foreach ($schemas as $s) {
        $out .= '  <script type="application/ld+json">' . json_encode($s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
    return $out;
}

/**
 * Breadcrumb JSON-LD schema.
 * @param array $crumbs [{name, url}, ...]
 */
function breadcrumb_schema(array $crumbs): array
{
    $list = array_map(fn($i, $c) => [
        '@type' => 'ListItem',
        'position' => $i + 1,
        'name' => $c['name'],
        'item' => $c['url'],
    ], array_keys($crumbs), array_values($crumbs));

    return [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $list,
    ];
}

/**
 * Article JSON-LD schema.
 */
function article_schema(array $article): array
{
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $article['title']['id'] ?? '',
        'image' => [SITE_URL . ($article['image'] ?? '/assets/images/hero.webp')],
        'datePublished' => $article['date'] ?? date('c'),
        'dateModified' => $article['updated'] ?? ($article['date'] ?? date('c')),
        'author' => [['@type' => 'Person', 'name' => BUSINESS['pic']]],
        'publisher' => ['@id' => SITE_URL . '/#business'],
        'description' => $article['excerpt']['id'] ?? '',
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => SITE_URL . '/artikel/' . ($article['slug'] ?? '')],
    ];
}

/**
 * Product schema for a car model.
 */
function car_schema(array $model): array
{
    return [
        '@context' => 'https://schema.org',
        '@type' => 'Car',
        'name' => $model['name'],
        'brand' => ['@type' => 'Brand', 'name' => 'Geely'],
        'model' => $model['id'],
        'image' => SITE_URL . ($model['image'] ?? ''),
        'offers' => [
            '@type' => 'Offer',
            'price' => $model['priceFrom'],
            'priceCurrency' => 'IDR',
            'availability' => 'https://schema.org/InStock',
            'seller' => ['@id' => SITE_URL . '/#business'],
        ],
    ];
}
