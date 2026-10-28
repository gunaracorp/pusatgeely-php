<?php
/** manifest.json — PWA manifest */
require_once __DIR__ . '/includes/page-shell.php';
header('Content-Type: application/manifest+json; charset=utf-8');

echo json_encode([
    'name' => BUSINESS['name'] . ' — Geely Bogor & Jabodetabek',
    'short_name' => BUSINESS['name'],
    'description' => BUSINESS['tagline_id'] ?? 'Partner pembelian Geely Anda di Bogor & Jabodetabek',
    'start_url' => '/',
    'display' => 'standalone',
    'background_color' => '#0c1210',
    'theme_color' => '#1aa37e',
    'lang' => 'id-ID',
    'dir' => 'ltr',
    'categories' => ['business', 'shopping', 'auto'],
    'icons' => [
        ['src' => '/assets/logo.svg', 'sizes' => 'any', 'type' => 'image/svg+xml', 'purpose' => 'any'],
        ['src' => '/assets/images/hero.webp', 'sizes' => '1440x720', 'type' => 'image/webp', 'purpose' => 'maskable'],
    ],
    'shortcuts' => [
        ['name' => 'Test Drive', 'url' => '/#test-drive', 'icons' => [['src' => '/assets/logo.svg', 'sizes' => 'any']]],
        ['name' => 'Harga', 'url' => '/harga-mobil-geely-bogor'],
        ['name' => 'Promo', 'url' => '/promo-geely-bogor'],
    ],
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
