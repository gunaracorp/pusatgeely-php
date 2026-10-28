# Pusat Geely — PHP Edition (Shared Hosting Ready)

Versi PHP murni dari website Pusat Geely (aslinya Next.js + React + Prisma + SQLite). Dikonversi untuk berjalan di shared hosting standar (cPanel, DirectAdmin, dll) tanpa Node.js, tanpa Composer, tanpa build step.

## Apa yang ada di paket ini?

✅ **48 file PHP** siap pakai
✅ **Styling lengkap** (dark premium theme, emerald accent) — 1 file CSS
✅ **JavaScript vanilla** (mobile menu, AI chat widget, financing simulator, FAQ accordion, language toggle, scroll progress, lightbox)
✅ **44 landing pages** (programmatic SEO) — auto-generated dari data
✅ **4 model detail pages** (EX5, EX2, Starray EM-i, Coolray)
✅ **8 artikel blog** lengkap dengan konten bilingual
✅ **8 perbandingan vs** (Geely vs kompetitor)
✅ **28 entri glosarium** (istilah EV/hybrid/kredit)
✅ **2.656 keyword index** (searchable)
✅ **AI Chat (Geely Bot)** via PHP cURL ke Z.ai API
✅ **Lead form** → MySQL + WhatsApp notification
✅ **Admin panel** (login, lihat leads, moderasi reviews, export CSV)
✅ **SEO lengkap**: sitemap.xml, robots.txt, manifest.json, llms.txt, llms-full.txt, feed.xml (RSS), JSON-LD schema (AutoDealer, FAQ, BreadcrumbList, Article, Car)
✅ **i18n ID/EN** (toggle bahasa)
✅ **Database MySQL** (PDO, auto-create tabel saat pertama diakses)
✅ **Assets lengkap** (foto unit, PDF promo, logo SVG)

---

## Cara Install (5 menit)

### Langkah 1 — Upload file

1. Unzip `pusatgeely-php.zip` di komputer kamu.
2. Buka cPanel → **File Manager** → masuk ke `public_html/` (atau subfolder domain kamu).
3. Upload semua isi folder `pusatgeely-php/` ke `public_html/`.
   - **Penting**: upload ISI folder, bukan folder-nya. Jadi `public_html/index.php`, bukan `public_html/pusatgeely-php/index.php`.

### Langkah 2 — Buat database MySQL

1. cPanel → **MySQL Databases** → **Create New Database**.
   - Nama bebas, mis. `pusatgeely_db`.
2. **Create New User**:
   - Username bebas, mis. `pusatgeely_user`.
   - Password: gunakan password generator (simpan!).
3. **Add User to Database**:
   - Pilih user + database di atas.
   - Centang **ALL PRIVILEGES** → **Make Changes**.

### Langkah 3 — Edit `config.php`

Buka `config.php` di File Manager → klik kanan → **Edit**. Ganti bagian ini:

```php
$DB = [
    'host'    => 'localhost',         // biasanya localhost
    'name'    => 'pusatgeely_db',     // nama database dari langkah 2
    'user'    => 'pusatgeely_user',   // username dari langkah 2
    'pass'    => 'PASSWORD_KAMU',     // password dari langkah 2
    'charset' => 'utf8mb4',
];
```

Lalu scroll ke bawah dan ganti:

```php
const SITE_URL = 'https://domain-kamu.com';     // ganti dengan domain kamu
const ADMIN_PASSWORD = 'ganti-password-kuat-disini';  // ganti password admin
```

### Langkah 4 — Tes website

Buka domain kamu di browser. Halaman beranda Pusat Geely akan muncul.

- Tabel database **otomatis dibuat** saat halaman pertama diakses (lihat `includes/db.php` → `db_ensure_schema()`).
- Tidak perlu import `database.sql` manual — tapi kalau mau, file itu juga tersedia di phpMyAdmin → Import.

### Langkah 5 — Tes admin panel

Buka `https://domain-kamu.com/admin/` → login dengan password dari `ADMIN_PASSWORD`.

---

## Fitur Opsional (Aktifkan kalau perlu)

### Aktifkan AI Chat (Geely Bot)

Default-nya, Geely Bot akan tampil tapi jawab dengan redirect WhatsApp. Untuk mengaktifkan AI penuh:

1. Daftar di [https://z.ai](https://z.ai) → dashboard → API keys → buat key baru.
2. Edit `config.php`:
   ```php
   const ZAI_API_KEY = 'api-key-kamu-disini';
   const ZAI_MODEL   = 'glm-4.6';
   ```
3. Simpan. Bot langsung aktif.

### Aktifkan Notifikasi WhatsApp Lead Baru

Setiap lead baru akan dicatat di `storage/wa_notif.log`. Untuk auto-kirim WA ke nomor pemilik (Sena):

**Opsi A — Tanpa API (gratis):**
Default. Cek log di admin panel atau `storage/wa_notif.log`.

**Opsi B — Pakai API WA pihak ketiga (Fonnte/Wablas/FastWA):**
1. Daftar di penyedia API WA, dapatkan URL + token.
2. Tambah di `config.php`:
   ```php
   const WA_API_URL   = 'https://api.fonnte.com/send';
   const WA_API_TOKEN = 'token-kamu-disini';
   ```
3. Lihat fungsi `notify_wa_lead_new()` di `includes/functions.php` — sudah ada hook-nya.

### Google Analytics 4

```php
const GA_ID = 'G-XXXXXXXXXX';
```

### Search Console verification

```php
const GOOGLE_VERIFICATION = 'kode-verifikasi-google';
const BING_VERIFICATION   = 'kode-verifikasi-bing';
const YANDEX_VERIFICATION = 'kode-verifikasi-yandex';
```

---

## Struktur Folder

```
pusatgeely-php/
├── index.php                      ← Beranda
├── 404.php                        ← Halaman tidak ditemukan
├── config.php                     ← ⚙️ KONFIGURASI (edit ini)
├── database.sql                   ← Schema MySQL (opsional, auto-create juga)
├── .htaccess                      ← Apache rewrite rules
├── google*.html                   ← Google Search Console verification
│
├── admin/                         ← Admin panel
│   ├── login.php
│   ├── index.php                  ← Dashboard
│   ├── leads.php                  ← Daftar leads + filter
│   ├── reviews.php                ← Moderasi review
│   ├── export.php                 ← Export CSV leads
│   └── logout.php
│
├── api/                           ← API endpoints
│   ├── leads.php                  ← POST lead form
│   ├── chat.php                   ← POST chat → Z.ai
│   ├── reviews.php                ← POST/GET reviews
│   └── indexnow.php               ← POST ping IndexNow
│
├── model/index.php                ← /model/{slug} — detail 4 model
├── artikel/index.php              ← /artikel (list) + /artikel/{slug}
├── vs/index.php                   ← /vs (list) + /vs/{slug}
├── kontak/index.php
├── tentang/index.php
├── harga-mobil-geely-bogor/index.php
├── promo-geely-bogor/index.php
├── glosarium/index.php
├── indeks-kata-kunci/index.php
├── landing/index.php              ← Router untuk 44 landing pages
│
├── sitemap.xml.php                ← Dynamic sitemap
├── robots.txt.php
├── manifest.json.php              ← PWA manifest
├── llms.txt.php                   ← Untuk AI assistants (LLMs)
├── llms-full.txt.php              ← Versi lengkap (model specs, FAQ, dll)
├── feed.xml.php                   ← RSS feed
│
├── includes/                      ← Shared code
│   ├── db.php                     ← PDO + auto-schema
│   ├── functions.php              ← Helpers (format IDR, WA link, dll)
│   ├── i18n.php                   ← String ID/EN
│   ├── seo.php                    ← JSON-LD schema builders
│   ├── header.php                 ← <head> + nav + mobile drawer
│   ├── footer.php                 ← Sitemap + CTA + AI chat widget
│   └── page-shell.php             ← Bootstrapper + render helpers
│
├── data/                          ← Konten (auto-generated dari TS aslinya)
│   ├── site.php                   ← BUSINESS, MODELS, AREAS, dll
│   ├── model-details.php          ← Spec lengkap per model
│   ├── articles.php               ← 8 artikel blog
│   ├── glossary.php               ← 28 istilah
│   ├── faq.php                    ← 8 FAQ
│   ├── promos.php                 ← 5 paket kredit
│   ├── competitors.php            ← 8 perbandingan
│   ├── seo-keywords.php           ← 2.656 keyword
│   ├── landing-pages-extra.php    ← 8 landing custom
│   ├── landing-grid.php           ← 36 landing model×area
│   ├── landing-all.php            ← 44 landing merged
│   └── branding.php               ← Digital support credits
│
├── assets/
│   ├── css/style.css              ← Single CSS (dark premium theme)
│   ├── js/main.js                 ← Single JS (vanilla, no framework)
│   ├── images/                    ← Foto unit, hero, galeri (webp)
│   ├── promos/                   ← 5 PDF simulasi kredit
│   ├── downloads/                ← ZIP source asli + panduan deploy
│   ├── logo.svg
│   ├── humans.txt
│   └── bc336b4b6001017bc99244eba80d0206.txt   ← IndexNow key
│
└── storage/                       ← Runtime files (rate-limit, WA notif log)
    └── .htaccess                  ← Deny public access
```

---

## Routing (URL Structure)

| URL | File |
|-----|------|
| `/` | `index.php` |
| `/kontak` | `kontak/index.php` |
| `/tentang` | `tentang/index.php` |
| `/harga-mobil-geely-bogor` | `harga-mobil-geely-bogor/index.php` |
| `/promo-geely-bogor` | `promo-geely-bogor/index.php` |
| `/glosarium` | `glosarium/index.php` |
| `/indeks-kata-kunci` | `indeks-kata-kunci/index.php` |
| `/artikel` | `artikel/index.php` |
| `/artikel/{slug}` | `artikel/index.php?slug={slug}` (via .htaccess) |
| `/vs` | `vs/index.php` |
| `/vs/{slug}` | `vs/index.php?slug={slug}` (via .htaccess) |
| `/model/{slug}` | `model/index.php?slug={slug}` (via .htaccess) |
| `/{landing-slug}` | `landing/index.php?slug={slug}` (via .htaccess, 44 slugs) |
| `/admin/` | `admin/index.php` |
| `/api/leads.php` | `api/leads.php` (POST) |
| `/api/chat.php` | `api/chat.php` (POST) |
| `/api/reviews.php` | `api/reviews.php` (GET/POST) |
| `/sitemap.xml` | `sitemap.xml.php` (via .htaccess) |
| `/robots.txt` | `robots.txt.php` (via .htaccess) |
| `/manifest.json` | `manifest.json.php` (via .htaccess) |
| `/feed.xml` | `feed.xml.php` (via .htaccess) |
| `/llms.txt` | `llms.txt.php` (via .htaccess) |
| `/llms-full.txt` | `llms-full.txt.php` (via .htaccess) |

---

## Troubleshooting

### "Maaf, sistem sedang mengalami gangguan..."

Koneksi database gagal. Cek:
- `config.php` — apakah `$DB` sudah benar (host, name, user, pass)?
- Apakah user database punya ALL PRIVILEGES?
- Apakah database sudah ada? (cPanel → MySQL Databases → cek nama database di list)

### Halaman 404 terus muncul

`.htaccess` tidak jalan. Pastikan:
- Apache `mod_rewrite` aktif (cPanel → biasanya default on).
- File `.htaccess` ter-upload (file hidden, perlu "Show Hidden Files" di File Manager).
- Alternatif: hubungi hosting provider untuk pastikan AllowOverride All.

### AI Bot tidak merespons

- Cek `ZAI_API_KEY` di `config.php` — harus diisi.
- Default-nya bot akan tetap merespons dengan redirect WhatsApp jika API key kosong.
- Cek error log di `storage/` atau PHP error log cPanel.

### Gambar tidak muncul

- Pastikan folder `assets/images/` ter-upload lengkap (sekitar 12MB, 27 foto webp).
- Jika gambar masih tidak muncul, cek permission folder: harus 755, file 644.

### Admin panel tidak bisa login

- Pastikan `ADMIN_PASSWORD` di `config.php` sudah diganti dari default.
- Password case-sensitive — pastikan ketik dengan benar.
- Browser cache: coba incognito/private mode.

### Leads tidak tersimpan

- Cek apakah tabel `leads` sudah dibuat (buka phpMyAdmin → database kamu → cek tabel `leads`).
- Tabel auto-create saat halaman pertama diakses. Kalau gagal, import manual `database.sql`.

---

## Backup & Maintenance

### Backup leads

- cPanel → phpMyAdmin → database kamu → Export → CSV/SQL.
- Atau lewat admin panel → Export CSV.

### Update konten

Semua konten ada di `data/*.php`. Edit file langsung (format PHP array). Contoh:
- Tambah artikel baru: edit `data/articles.php`, tambah entri ke `$ARTICLES` array.
- Update harga: edit `data/site.php`, cari `$MODELS` array.
- Tambah FAQ: edit `includes/i18n.php` di section `faq.items`.

### Keamanan

- Ganti `ADMIN_PASSWORD` secara berkala.
- Set permission: `config.php` 600 (hanya owner bisa baca), folder lain 755, file 644.
- Aktifkan HTTPS (Let's Encrypt gratis di cPanel).
- Backup berkala via cPanel → Backup.

---

## Sumber & Lisensi

Dikonversi dari repo `gunaracorp/pusatgeely` (Next.js 16 + React 19 + Prisma + SQLite) ke PHP murni untuk shared hosting.

Konten (foto unit, harga, spesifikasi, artikel) — milik Pusat Geely / Sena Sulaeman.
Kode PHP — bebas dipakai untuk keperluan Pusat Geely.

---

## Bantuan

Ada masalah? Chat WhatsApp: +62 816-6111-42 (Sena).
Atau buka issue di repo asli: https://github.com/gunaracorp/pusatgeely
