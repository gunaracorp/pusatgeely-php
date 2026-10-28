<?php
/**
 * ════════════════════════════════════════════════════════════════
 *  PUSAT GEELY — PHP Edition for Shared Hosting
 *  Single source of truth untuk konfigurasi situs.
 * ════════════════════════════════════════════════════════════════
 *
 *  CARA PAKAI:
 *  1. Upload semua file ke public_html/ (atau subfolder).
 *  2. Buat database MySQL via cPanel, import database.sql.
 *  3. Edit $DB di bawah dengan kredensial database kamu.
 *  4. (Opsional) Isi $ZAI_API_KEY untuk mengaktifkan Geely Bot AI.
 *  5. (Opsional) Isi $WA_NOTIF_TARGET untuk notif WA lead baru.
 *  6. Buka domain kamu di browser — selesai!
 */

// ─────────────────────────────────────────────────────────────────
//  KONFIGURASI DATABASE (MySQL via PDO)
//  Isi dengan kredensial dari cPanel → MySQL Databases
// ─────────────────────────────────────────────────────────────────
$DB = [
    'host'    => 'localhost',         // biasanya 'localhost'
    'name'    => 'pusatgeely',        // nama database dari cPanel
    'user'    => 'root',              // username database
    'pass'    => '',                  // password database
    'charset' => 'utf8mb4',
];

// ─────────────────────────────────────────────────────────────────
//  KONFIGURASI SITUS
// ─────────────────────────────────────────────────────────────────
const SITE_NAME      = 'Pusat Geely';
const SITE_TAGLINE   = 'Partner pembelian Geely Anda di Bogor & Jabodetabek';

// URL produksi situs (TANPA trailing slash) — dipakai untuk canonical,
// sitemap, JSON-LD, OG tags. Ganti dengan domain kamu saat sudah upload.
const SITE_URL = 'https://pusatgeely.web.id';

// Default bahasa: 'id' atau 'en'
const DEFAULT_LANG = 'id';

// Aktifkan mode debug (true saat development, false di production)
const DEBUG_MODE = false;

// ─────────────────────────────────────────────────────────────────
//  ADMIN PANEL
//  Akses di /admin/ — login dengan password di bawah.
// ─────────────────────────────────────────────────────────────────
const ADMIN_PASSWORD = 'ubah-password-admin-disini';

// ─────────────────────────────────────────────────────────────────
//  GEELY BOT (AI Chat Widget) — OPSIONAL
//
//  Untuk mengaktifkan, isi ZAI_API_KEY dengan API key dari
//  https://z.ai (cekgan dashboard → API keys).
//  Jika kosong → widget tampil dengan redirect WhatsApp.
// ─────────────────────────────────────────────────────────────────
const ZAI_API_KEY    = '';
const ZAI_MODEL      = 'glm-4.6';      // model default Z.ai
const ZAI_API_URL    = 'https://api.z.ai/api/paas/v4/chat/completions';

// ─────────────────────────────────────────────────────────────────
//  NOTIFIKASI WHATSAPP LEAD BARU — OPSIONAL
//
//  Setiap lead baru otomatis kirim WA ke nomor di bawah.
//  Pakai wa.me link (gratis, tanpa API berbayar).
//  Format: 62XXX (tanpa '+' atau '0' di depan)
// ─────────────────────────────────────────────────────────────────
const WA_NOTIF_TARGET = '62816611142'; // nomor pemilik (Sena)

// ─────────────────────────────────────────────────────────────────
//  DATA BISNIS
// ─────────────────────────────────────────────────────────────────
const BUSINESS = [
    'name'         => 'Pusat Geely',
    'pic'          => 'Sena Sulaeman',
    'role_id'      => 'Konsultan Penjualan',
    'role_en'      => 'Sales Consultant',
    'wa_number'    => '62816611142',
    'wa_display'   => '+62 816-6111-42',
    'email'        => 'pusatgeely@gmail.com',
    'instagram'    => '@salesconsultant1972',
    'instagram_url'=> 'https://instagram.com/salesconsultant1972',
    'facebook'     => 'Eman Sulaeman',
    'facebook_url' => 'https://www.facebook.com/100008079428678',
    'tiktok'       => '@eman.sulaeman0839',
    'tiktok_url'   => 'https://www.tiktok.com/@eman.sulaeman0839',
    'x_handle'     => '@EmanSulaem79261',
    'x_url'        => 'https://x.com/EmanSulaem79261',
    'hours_id'     => 'Setiap hari • 08.00–20.00 WIB',
    'hours_en'     => 'Every day • 08:00–20:00 WIB',
    'region_id'    => 'Bogor & Jabodetabek',
    'region_en'    => 'Bogor & Jabodetabek',
];

// ─────────────────────────────────────────────────────────────────
//  GOOGLE ANALYTICS 4 (opsional)
//  Isi dengan ID GA4 kamu (mis. 'G-XXXXXXXXXX') untuk aktifkan.
// ─────────────────────────────────────────────────────────────────
const GA_ID = '';

// ─────────────────────────────────────────────────────────────────
//  SEARCH CONSOLE VERIFICATION (opsional)
//  Isi kode verifikasi dari Google/Bing/Yandex Webmaster.
// ─────────────────────────────────────────────────────────────────
const GOOGLE_VERIFICATION = '';
const BING_VERIFICATION   = '';
const YANDEX_VERIFICATION = '';

// ─────────────────────────────────────────────────────────────────
//  TIMEZONE
// ─────────────────────────────────────────────────────────────────
date_default_timezone_set('Asia/Jakarta');

// ─────────────────────────────────────────────────────────────────
//  ERROR HANDLING
// ─────────────────────────────────────────────────────────────────
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    ini_set('display_errors', '0');
}

// Session untuk admin panel
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
