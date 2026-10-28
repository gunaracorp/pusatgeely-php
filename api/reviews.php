<?php
/**
 * POST /api/reviews.php — receive customer reviews (pending moderation).
 * GET  /api/reviews.php?model=ex5 — get published reviews for a model.
 */

require_once __DIR__ . '/../includes/page-shell.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    // Public endpoint — list published reviews
    $model = $_GET['model'] ?? '';
    if (!$model) {
        json_response(['ok' => false, 'error' => 'model_required'], 400);
    }
    try {
        $pdo = db();
        $stmt = $pdo->prepare("SELECT name, city, rating, comment, created_at FROM reviews WHERE model_id = ? AND published = 1 ORDER BY created_at DESC LIMIT 50");
        $stmt->execute([$model]);
        $reviews = $stmt->fetchAll();
        json_response(['ok' => true, 'reviews' => $reviews]);
    } catch (Throwable $e) {
        error_log('[reviews GET] ' . $e->getMessage());
        json_response(['ok' => false, 'error' => 'server_error'], 500);
    }
}

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    if (!is_array($body)) $body = $_POST;

    if (!csrf_check($body['csrf'] ?? null)) {
        json_response(['ok' => false, 'error' => 'invalid_csrf'], 403);
    }

    $ip = client_ip();
    if (!rate_limit_check('review_' . $ip, 3, 3600)) {
        json_response(['ok' => false, 'error' => 'rate_limited'], 429);
    }

    $modelId = trim($body['modelId'] ?? $body['model_id'] ?? '');
    $name = trim($body['name'] ?? '');
    $city = trim($body['city'] ?? '') ?: null;
    $rating = (int)($body['rating'] ?? 5);
    $comment = trim($body['comment'] ?? '');

    if (!$modelId || !$name || !$comment) {
        json_response(['ok' => false, 'error' => 'fields_required'], 422);
    }
    if ($rating < 1 || $rating > 5) $rating = 5;
    if (mb_strlen($name) > 255 || mb_strlen($comment) > 2000) {
        json_response(['ok' => false, 'error' => 'too_long'], 422);
    }
    // Validate model
    $validModels = array_map(fn($m) => $m['id'], $GLOBALS['MODELS']);
    if (!in_array($modelId, $validModels, true)) {
        json_response(['ok' => false, 'error' => 'invalid_model'], 422);
    }

    try {
        $pdo = db();
        $id = db_id();
        $stmt = $pdo->prepare("INSERT INTO reviews (id, model_id, name, city, rating, comment, published) VALUES (:id, :mid, :name, :city, :rating, :comment, 0)");
        $stmt->execute([
            ':id' => $id,
            ':mid' => $modelId,
            ':name' => $name,
            ':city' => $city,
            ':rating' => $rating,
            ':comment' => $comment,
        ]);
        json_response(['ok' => true, 'id' => $id, 'message' => 'Review received. Will appear after moderation.'], 201);
    } catch (Throwable $e) {
        error_log('[reviews POST] ' . $e->getMessage());
        json_response(['ok' => false, 'error' => 'server_error'], 500);
    }
}

json_response(['ok' => false, 'error' => 'method_not_allowed'], 405);
