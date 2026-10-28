<?php
/**
 * POST /api/leads.php — receive lead form submissions, save to DB, notify WA.
 */

require_once __DIR__ . '/../includes/page-shell.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'error' => 'method_not_allowed'], 405);
}

$body = json_decode(file_get_contents('php://input'), true);
if (!is_array($body)) {
    // Fallback to form-encoded
    $body = $_POST;
}

// CSRF check
if (!csrf_check($body['csrf'] ?? null)) {
    json_response(['ok' => false, 'error' => 'invalid_csrf'], 403);
}

// Rate limit: max 5 leads per IP per 10 min
$ip = client_ip();
if (!rate_limit_check('lead_' . $ip, 5, 600)) {
    json_response(['ok' => false, 'error' => 'rate_limited'], 429);
}

// Validate
$name = trim($body['name'] ?? '');
$phone = trim($body['phone'] ?? '');
$model = trim($body['model'] ?? '') ?: null;
$interest = trim($body['interest'] ?? 'general');
$area = trim($body['area'] ?? '') ?: null;
$preferredDate = trim($body['preferredDate'] ?? $body['preferred_date'] ?? '') ?: null;
$message = trim($body['message'] ?? '') ?: null;
$lang = in_array($body['lang'] ?? '', ['id', 'en'], true) ? $body['lang'] : 'id';
$source = trim($body['source'] ?? 'website') ?: 'website';

if ($name === '' || $phone === '') {
    json_response(['ok' => false, 'error' => 'name_and_phone_required'], 422);
}
if (mb_strlen($name) > 255 || mb_strlen($phone) > 64) {
    json_response(['ok' => false, 'error' => 'field_too_long'], 422);
}
// Phone format check (loose)
if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) {
    json_response(['ok' => false, 'error' => 'invalid_phone'], 422);
}
// Model validation
if ($model) {
    $validModels = array_map(fn($m) => $m['id'], $MODELS);
    if (!in_array($model, $validModels, true)) $model = null;
}
// Interest validation
if (!in_array($interest, ['test-drive', 'price', 'financing', 'trade-in', 'general'], true)) {
    $interest = 'general';
}

// Save to DB
try {
    $pdo = db();
    $id = db_id();
    $stmt = $pdo->prepare("INSERT INTO leads
        (id, name, phone, model, interest, area, preferred_date, message, lang, source, status, ip, user_agent)
        VALUES (:id, :name, :phone, :model, :interest, :area, :preferred_date, :message, :lang, :source, 'new', :ip, :ua)");
    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':phone' => $phone,
        ':model' => $model,
        ':interest' => $interest,
        ':area' => $area,
        ':preferred_date' => $preferredDate,
        ':message' => $message,
        ':lang' => $lang,
        ':source' => $source,
        ':ip' => $ip,
        ':ua' => user_agent(),
    ]);

    // WA notification
    $lead = compact('name', 'phone', 'model', 'interest', 'area', 'preferred_date', 'preferredDate', 'message', 'lang', 'ip');
    notify_wa_lead_new($lead);

    json_response([
        'ok' => true,
        'id' => $id,
        'message' => $lang === 'en'
            ? 'Thank you! We received your request. We\'ll contact you soon.'
            : 'Terima kasih! Permintaan Anda kami terima. Kami hubungi Anda segera.',
    ], 201);
} catch (Throwable $e) {
    error_log('[leads] ' . $e->getMessage());
    json_response(['ok' => false, 'error' => 'server_error'], 500);
}
