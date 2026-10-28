<?php
/** sitemap.xml — dynamic sitemap */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: application/xml; charset=utf-8');
header('Cache-Control: public, max-age=3600');

$urls = [];
$now = date('Y-m-d');

// Homepage
$urls[] = ['loc' => SITE_URL . '/', 'lastmod' => $now, 'priority' => '1.0', 'changefreq' => 'daily'];

// Static pages
$staticPages = [
    'harga-mobil-geely-bogor' => '0.9',
    'promo-geely-bogor' => '0.9',
    'kontak' => '0.7',
    'tentang' => '0.7',
    'glosarium' => '0.6',
    'indeks-kata-kunci' => '0.8',
    'artikel' => '0.8',
    'vs' => '0.8',
];
foreach ($staticPages as $path => $priority) {
    $urls[] = ['loc' => SITE_URL . '/' . $path, 'priority' => $priority, 'changefreq' => 'weekly'];
}

// Model detail pages
foreach ($MODELS as $m) {
    $urls[] = ['loc' => SITE_URL . '/model/' . $m['id'], 'priority' => '0.9', 'changefreq' => 'weekly'];
}

// Article pages
foreach ($ARTICLES as $a) {
    $urls[] = ['loc' => SITE_URL . '/artikel/' . $a['slug'], 'lastmod' => $a['updated'] ?? $a['date'], 'priority' => '0.7', 'changefreq' => 'monthly'];
}

// VS comparison pages
foreach ($COMPARES as $c) {
    $urls[] = ['loc' => SITE_URL . '/vs/' . $c['slug'], 'priority' => '0.7', 'changefreq' => 'monthly'];
}

// Landing pages (44 of them)
foreach ($ALL_LANDING_PAGES as $lp) {
    if (!empty($lp['slug'])) {
        $urls[] = ['loc' => SITE_URL . '/' . $lp['slug'], 'priority' => '0.6', 'changefreq' => 'monthly'];
    }
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($urls as $u) {
    echo '  <url>' . "\n";
    echo '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1) . '</loc>' . "\n";
    if (!empty($u['lastmod'])) echo '    <lastmod>' . $u['lastmod'] . '</lastmod>' . "\n";
    if (!empty($u['changefreq'])) echo '    <changefreq>' . $u['changefreq'] . '</changefreq>' . "\n";
    if (!empty($u['priority'])) echo '    <priority>' . $u['priority'] . '</priority>' . "\n";
    echo '  </url>' . "\n";
}
echo '</urlset>' . "\n";
