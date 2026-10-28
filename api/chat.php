<?php
/**
 * POST /api/chat.php — Geely Bot AI chat using Z.ai API (via PHP cURL).
 * Requires ZAI_API_KEY in config.php. If not set, returns a WA handoff reply.
 */

require_once __DIR__ . '/../includes/page-shell.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['ok' => false, 'error' => 'method_not_allowed'], 405);
}

$body = json_decode(file_get_contents('php://input'), true);
if (!is_array($body)) $body = $_POST;

$ip = client_ip();
// Rate limit: 20 messages per IP per 5 min (loose — chat is conversational)
if (!rate_limit_check('chat_' . $ip, 20, 300)) {
    json_response(['ok' => false, 'error' => 'rate_limited'], 429);
}

$messages = $body['messages'] ?? [];
$lang = in_array($body['lang'] ?? '', ['id', 'en'], true) ? $body['lang'] : 'id';

// Validate messages
if (!is_array($messages) || count($messages) < 1) {
    json_response(['ok' => false, 'error' => 'no_messages'], 422);
}
// Sanitize & cap to last 12 messages
$messages = array_slice($messages, -12);
$cleanMessages = [];
foreach ($messages as $m) {
    if (!isset($m['role'], $m['content'])) continue;
    $role = $m['role'] === 'user' ? 'user' : 'assistant';
    $content = mb_substr(trim((string)$m['content']), 0, 1000);
    if ($content === '') continue;
    $cleanMessages[] = ['role' => $role, 'content' => $content];
}
if (empty($cleanMessages)) {
    json_response(['ok' => false, 'error' => 'no_valid_messages'], 422);
}

// If no API key → return WA handoff
if (!defined('ZAI_API_KEY') || ZAI_API_KEY === '') {
    $waText = $lang === 'en'
        ? "Halo Pusat Geely, saya ingin bertanya lebih lanjut tentang Geely."
        : "Halo Pusat Geely, saya baru saja chat dengan Geely Bot dan ingin konsultasi lebih lanjut.";
    $reply = $lang === 'en'
        ? "I can't connect to the AI right now, but Sena is online on WhatsApp. Tap the button below to continue the conversation — I'll make sure you get a fast response. 🙏"
        : "Maaf, koneksi AI sedang terganggu. Sena sedang online di WhatsApp — tekan tombol di bawah untuk lanjut chat langsung, saya pastikan dibalas cepat. 🙏";
    json_response([
        'ok' => true,
        'reply' => $reply,
        'waUrl' => wa_link($waText),
    ]);
}

// Build system prompt
$systemPrompt = build_system_prompt($lang);

// Build Z.ai API request
$apiMessages = [
    ['role' => 'system', 'content' => $systemPrompt],
    ...$cleanMessages,
];

$payload = [
    'model' => ZAI_MODEL,
    'messages' => $apiMessages,
    'temperature' => 0.5,
    'max_tokens' => 800,
    'stream' => false,
];

$ch = curl_init(ZAI_API_URL);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . ZAI_API_KEY,
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 25,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => true,
]);

$rawResponse = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr = curl_error($ch);
curl_close($ch);

if ($rawResponse === false || $httpCode >= 400) {
    error_log('[chat] Z.ai API error: ' . $curlErr . ' (HTTP ' . $httpCode . ')');
    $waText = $lang === 'en'
        ? "Halo Pusat Geely, saya ingin bertanya lebih lanjut."
        : "Halo Pusat Geely, saya baru saja chat dengan Geely Bot dan ingin konsultasi lebih lanjut.";
    $reply = $lang === 'en'
        ? "Hmm, the AI hiccupped. Sena is online on WhatsApp — tap below to continue, fast response guaranteed. 🙏"
        : "Waduh, AI-nya sedang gangguan. Sena online di WhatsApp — klik tombol di bawah untuk lanjut chat, dijamin cepat. 🙏";
    json_response([
        'ok' => true,
        'reply' => $reply,
        'waUrl' => wa_link($waText),
    ]);
}

$data = json_decode($rawResponse, true);
$reply = $data['choices'][0]['message']['content'] ?? null;

if (!$reply) {
    $reply = $lang === 'en'
        ? "Sorry, I couldn't generate a reply. Please try again or contact us via WhatsApp."
        : "Maaf, saya belum bisa menjawab. Coba lagi atau hubungi kami via WhatsApp.";
}

// Detect intent to escalate to WhatsApp (heuristic)
$waUrl = null;
$escalationKeywords = ['test drive', 'booking', 'jadwalkan', 'kunjungi', 'wa', 'whatsapp', 'hubungi', 'chat langsung'];
foreach ($escalationKeywords as $kw) {
    if (stripos($reply, $kw) !== false || stripos(implode(' ', array_column($cleanMessages, 'content')), $kw) !== false) {
        $waText = $lang === 'en'
            ? "Halo Pusat Geely, saya ingin lanjut chat tentang Geely."
            : "Halo Pusat Geely, saya baru chat dengan Geely Bot dan ingin lanjut konsultasi.";
        $waUrl = wa_link($waText);
        break;
    }
}

// Log to DB (optional)
try {
    $pdo = db();
    $sessionId = substr(md5($ip . ($_SERVER['HTTP_USER_AGENT'] ?? '')), 0, 32);
    $stmt = $pdo->prepare("INSERT INTO chat_logs (session_id, lang, user_msg, bot_reply, ip) VALUES (:sid, :lang, :um, :br, :ip)");
    $lastUser = end($cleanMessages)['content'] ?? '';
    $stmt->execute([
        ':sid' => $sessionId,
        ':lang' => $lang,
        ':um' => mb_substr($lastUser, 0, 2000),
        ':br' => mb_substr($reply, 0, 2000),
        ':ip' => $ip,
    ]);
} catch (Throwable $e) {
    error_log('[chat_log] ' . $e->getMessage());
}

json_response([
    'ok' => true,
    'reply' => $reply,
    'waUrl' => $waUrl,
]);

/**
 * Build the system prompt — give the AI the data it needs.
 */
function build_system_prompt(string $lang): string
{
    global $BUSINESS, $MODELS, $AREAS, $PROMO_PROGRAMS, $PRICE_DISCLAIMER;

    $langLine = $lang === 'en' ? 'Respond in English.' : 'Jawab dalam Bahasa Indonesia.';

    $modelsText = [];
    foreach ($MODELS as $m) {
        $modelsText[] = "- {$m['name']} ({$m['id']}): harga mulai " . format_idr($m['priceFrom']) . " — " . $m['blurb']['id'];
    }
    $modelsText = implode("\n", $modelsText);

    $areasText = implode(', ', $AREAS);

    $business = $BUSINESS;
    $waNumber = $business['wa_number'];

    return <<<PROMPT
Anda adalah "Geely Bot", asisten AI ramah untuk Pusat Geely — konsultan penjualan independen Geely di Bogor & Jabodetabek. Anda BUKAN bagian dari dealer resmi Geely, tetapi membantu pelanggan memilih, memahami harga, dan menjadwalkan test drive.

INFORMASI PRODUK (data per September 2026, indikatif OTR):
{$modelsText}

AREA LAYANAN: {$areasText}

KONTAK:
- Konsultan: {$business['pic']} (WhatsApp: +{$waNumber}, tampil: {$business['wa_display']})
- Email: {$business['email']}
- Jam layanan: 08.00–20.00 WIB setiap hari

PROMO & KREDIT:
- 5 perusahaan pembiayaan: CIMB Niaga, BRI Finance, BNI Finance, Mandiri Utama, IMFI
- DP mulai ±20%, tenor hingga 6 tahun
- PDF simulasi tersedia di /assets/promos/

ATURAN JAWABAN:
1. Selalu jujur: jika tidak tahu pasti, arahkan pelanggan untuk konfirmasi via WhatsApp.
2. Harga yang Anda sebut SELALU ditandai "indikatif" dan sarankan konfirmasi.
3. Jangan klaim Pusat Geely adalah dealer resmi — selalu "konsultan penjualan independen".
4. Jika pelanggan menanyakan test drive, booking, atau hal yang butuh follow-up personal → sarankan untuk lanjut chat WhatsApp (sertakan link wa.me/{$waNumber}).
5. Jawaban ringkas, hangat, dan to-the-point. Hindari puitis berlebihan.
6. Boleh pakai emoji secukupnya (👍, 🙏, 🚗) tapi jangan berlebihan.
7. Jika ditanya hal di luar topik Geely/otomotif → balas dengan ramah dan kembalikan ke topik Geely.
8. Maksimal 4 paragraf per jawaban.
9. {$langLine}

Pengetahuan umum EV/hybrid/otomotif boleh dipakai. Selalu prioritaskan data Pusat Geely di atas pengetahuan umum.
PROMPT;
}
