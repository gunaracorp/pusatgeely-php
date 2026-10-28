<?php
/**
 * POST /api/indexnow.php — ping IndexNow (Bing/Yandex) for instant indexing.
 * Body: {"urls": ["https://...","https://..."]}
 */

require_once __DIR__ . '/../includes/page-shell.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'error' => 'method_not_allowed'], 405);
}

$body = json_decode(file_get_contents('php://input'), true);
if (!is_array($body)) $body = $_POST;

$urls = $body['urls'] ?? [];
if (!is_array($urls) || count($urls) < 1) {
    json_response(['ok' => false, 'error' => 'no_urls'], 422);
}
// Cap to 10000 URLs per request (IndexNow limit)
$urls = array_slice($urls, 0, 10000);
// Sanitize — only allow our own domain
$urls = array_values(array_filter($urls, fn($u) => is_string($u) && str_starts_with($u, SITE_URL)));

if (empty($urls)) {
    json_response(['ok' => false, 'error' => 'no_valid_urls'], 422);
}

$key = 'bc336b4b6001017bc99244eba80d0206'; // matches /assets/bc336b4b6001017bc99244eba80d0206.txt
$payload = [
    'host' => parse_url(SITE_URL, PHP_URL_HOST),
    'key' => $key,
    'keyLocation' => SITE_URL . '/assets/' . $key . '.txt',
    'urlList' => $urls,
];

$ch = curl_init('https://api.indexnow.org/IndexNow');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_SLASHES),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json; charset=utf-8'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
]);
$rawResponse = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

json_response([
    'ok' => $httpCode >= 200 && $httpCode < 300,
    'submitted' => count($urls),
    'indexnow_status' => $httpCode,
]);
