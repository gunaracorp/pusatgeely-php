<?php
/** 404 Not Found page */
require_once __DIR__ . '/includes/page-shell.php';
$waLink = wa_link('Halo Pusat Geely, saya mencari halaman tertentu di website Anda.');

http_response_code(404);
page_header([
    'title' => '404 — Halaman Tidak Ditemukan | Pusat Geely',
    'description' => 'Halaman yang Anda cari tidak ditemukan. Kembali ke beranda atau chat WhatsApp kami.',
    'canonical' => SITE_URL . '/404',
    'defaultSchema' => false,
]);
?>
<main style="min-height:60vh; display:flex; align-items:center; justify-content:center; padding:2rem 0;">
    <div style="text-align:center; max-width:32rem;">
        <div class="font-display" style="font-size:clamp(4rem, 12vw, 8rem); font-weight:900; color:var(--primary); line-height:1;">404</div>
        <h1 class="font-display" style="margin-top:1rem; font-size:1.5rem; font-weight:700;">Halaman tidak ditemukan</h1>
        <p style="margin-top:0.75rem; color:var(--muted-foreground);">Maaf, halaman yang Anda cari tidak ada atau sudah dipindahkan. Coba kembali ke beranda atau cari lewat menu.</p>
        <div style="margin-top:1.5rem; display:flex; gap:0.625rem; justify-content:center; flex-wrap:wrap;">
            <a href="/" class="btn btn-primary btn-lg">← Beranda</a>
            <a href="/artikel" class="btn btn-outline btn-lg">Artikel</a>
            <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">Chat WhatsApp</a>
        </div>
        <div style="margin-top:2rem;">
            <p style="font-size:0.8125rem; color:var(--muted-foreground);">Atau jelajahi:</p>
            <div style="margin-top:0.5rem; display:flex; gap:0.375rem; justify-content:center; flex-wrap:wrap;">
                <a href="/harga-mobil-geely-bogor" class="badge badge-outline" style="padding:0.5rem 0.875rem; text-decoration:none;">Harga</a>
                <a href="/promo-geely-bogor" class="badge badge-outline" style="padding:0.5rem 0.875rem; text-decoration:none;">Promo</a>
                <a href="/glosarium" class="badge badge-outline" style="padding:0.5rem 0.875rem; text-decoration:none;">Glosarium</a>
                <a href="/indeks-kata-kunci" class="badge badge-outline" style="padding:0.5rem 0.875rem; text-decoration:none;">2.600+ Kata Kunci</a>
                <a href="/vs" class="badge badge-outline" style="padding:0.5rem 0.875rem; text-decoration:none;">Perbandingan</a>
            </div>
        </div>
    </div>
</main>
<?php page_footer(false); ?>
