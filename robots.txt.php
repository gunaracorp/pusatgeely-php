<?php
/** robots.txt — dynamic */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: text/plain; charset=utf-8');

echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /admin/\n";
echo "Disallow: /api/\n";
echo "Disallow: /includes/\n";
echo "Disallow: /data/\n";
echo "Disallow: /storage/\n";
echo "Disallow: /*.php$\n";
echo "Disallow: /config.php\n";
echo "\n";
echo "Sitemap: " . SITE_URL . "/sitemap.xml\n";
