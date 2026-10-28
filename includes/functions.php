<?php
/**
 * Helper functions untuk Pusat Geely PHP Edition.
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';

// ─────────────────────────────────────────────────────────────────
//  Formatting
// ─────────────────────────────────────────────────────────────────

/** Format IDR price — e.g. "Rp 465.000.000" */
function format_idr(int $value): string
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

/** Compact price like "Rp 465 jt" for cards */
function format_juta(int $value): string
{
    $jt = $value / 1_000_000;
    $rounded = (fmod($jt, 1.0) == 0.0) ? (string)(int)$jt : str_replace('.', ',', number_format($jt, 1));
    return 'Rp ' . $jt . ' jt';
}

/** WhatsApp deep-link builder */
function wa_link(string $text): string
{
    return 'https://wa.me/' . BUSINESS['wa_number'] . '?text=' . rawurlencode($text);
}

/** Truncate text */
function truncate(string $text, int $max = 160): string
{
    if (mb_strlen($text) <= $max) return $text;
    return mb_substr($text, 0, $max - 1) . '…';
}

/** Slugify (URL-safe) */
function slugify(string $text): string
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return preg_replace('~-+~', '-', $text) ?? '';
}

/** Escape HTML */
function e(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/** Echo with nl2br + escape */
function e_br(?string $s): string
{
    return nl2br(e($s));
}

// ─────────────────────────────────────────────────────────────────
//  Language (i18n)
// ─────────────────────────────────────────────────────────────────

function current_lang(): string
{
    // 1. ?lang=en in URL
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['id', 'en'], true)) {
        setcookie('pg_lang', $_GET['lang'], time() + 86400 * 30, '/');
        return $_GET['lang'];
    }
    // 2. Cookie
    if (isset($_COOKIE['pg_lang']) && in_array($_COOKIE['pg_lang'], ['id', 'en'], true)) {
        return $_COOKIE['pg_lang'];
    }
    // 3. Accept-Language header
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        foreach (['en', 'id'] as $lang) {
            if (stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang) === 0) {
                return $lang === 'en' ? 'en' : DEFAULT_LANG;
            }
        }
    }
    return DEFAULT_LANG;
}

function lang_toggle_url(string $current_lang, string $target_lang): string
{
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $sep = str_contains($uri, '?') ? '&' : '?';
    return $uri . $sep . 'lang=' . $target_lang;
}

// ─────────────────────────────────────────────────────────────────
//  Client IP & UA
// ─────────────────────────────────────────────────────────────────

function client_ip(): string
{
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'] as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(explode(',', $_SERVER[$key])[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return '0.0.0.0';
}

function user_agent(): string
{
    return substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);
}

// ─────────────────────────────────────────────────────────────────
//  Rate limiting (simple file-based)
// ─────────────────────────────────────────────────────────────────

function rate_limit_check(string $key, int $max, int $window_sec): bool
{
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $file = $dir . '/rl_' . md5($key);
    $now = time();
    $data = is_file($file) ? json_decode((string)file_get_contents($file), true) : [];

    // Drop old entries
    $data = array_filter($data ?: [], fn($t) => $t > $now - $window_sec);
    if (count($data) >= $max) return false;
    $data[] = $now;
    file_put_contents($file, json_encode($data), LOCK_EX);
    return true;
}

// ─────────────────────────────────────────────────────────────────
//  WhatsApp notification (lead baru) — pakai wa.me link + log
//  Untuk auto-send WA, gunakan API WA pihak ketigai (Fonnte, Wablas, dll)
//  Disini kita catat ke storage/wa_notif.log sebagai backup.
// ─────────────────────────────────────────────────────────────────

function notify_wa_lead_new(array $lead): void
{
    $msg = "🔔 *LEAD BARU Pusat Geely*\n"
         . "Nama: {$lead['name']}\n"
         . "Telp: {$lead['phone']}\n"
         . "Model: " . ($lead['model'] ?? '-') . "\n"
         . "Minat: {$lead['interest']}\n"
         . "Area: " . ($lead['area'] ?? '-') . "\n"
         . "Tanggal Pref: " . ($lead['preferred_date'] ?? '-') . "\n"
         . "Pesan: " . ($lead['message'] ?? '-') . "\n"
         . "Bahasa: {$lead['lang']}\n"
         . "Waktu: " . date('Y-m-d H:i:s') . "\n"
         . "IP: " . ($lead['ip'] ?? '-');

    // Log ke file (backup jika API WA belum di-set)
    $dir = __DIR__ . '/../storage';
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    @file_put_contents($dir . '/wa_notif.log', $msg . "\n\n", FILE_APPEND | LOCK_EX);

    // Kirim via API WA eksternal jika dikonfigurasi di config.php
    // (placeholder — user bisa extend dengan Fonnte/Wablas/FastWA dll)
    if (defined('WA_API_URL') && defined('WA_API_TOKEN') && WA_API_URL && WA_API_TOKEN) {
        $payload = json_encode([
            'target'  => WA_NOTIF_TARGET,
            'message' => $msg,
        ]);
        $ch = curl_init(WA_API_URL);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . WA_API_TOKEN,
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 5,
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
}

// ─────────────────────────────────────────────────────────────────
//  JSON response
// ─────────────────────────────────────────────────────────────────

function json_response($data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_check(?string $token): bool
{
    return !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token ?? '');
}

// ─────────────────────────────────────────────────────────────────
//  Admin auth
// ─────────────────────────────────────────────────────────────────

function admin_logged_in(): bool
{
    return !empty($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true;
}

function admin_require_login(): void
{
    if (!admin_logged_in()) {
        header('Location: /admin/login.php');
        exit;
    }
}

// ─────────────────────────────────────────────────────────────────
//  Bootstrapper — panggil di awal setiap halaman publik
// ─────────────────────────────────────────────────────────────────

function bootstrap(): void
{
    static $done = false;
    if ($done) return;
    $done = true;

    // Ensure schema exists (idempotent)
    db_ensure_schema();
}
