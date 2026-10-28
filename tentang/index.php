<?php
/** Tentang page */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya ingin kenali layanan Anda lebih lanjut.');

page_header([
    'active' => 'about',
    'title' => t('tentang', 'title'),
    'description' => t('tentang', 'subtitle'),
    'canonical' => SITE_URL . '/tentang',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('tentang', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('tentang', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('tentang', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width:48rem;">
            <div class="article-body">
                <p><?= $lang === 'en'
                    ? 'Pusat Geely is an independent sales-consulting service for Geely vehicles in Bogor and Greater Jakarta. We are not an official Geely dealer — instead, we act as your personal guide from initial research through to handover day, helping you choose the right model, secure the best financing, and arrange test drives and trade-ins.'
                    : 'Pusat Geely adalah layanan konsultan penjualan independen untuk kendaraan Geely di Bogor dan Jabodetabek. Kami bukan dealer resmi Geely — melainkan mitra personal Anda dari riset awal sampai hari serah terima, membantu memilih model yang tepat, mengamankan pembiayaan terbaik, serta mengatur test drive dan trade-in.'; ?></p>

                <p><?= $lang === 'en'
                    ? 'Our role covers four areas. First, guiding your model choice based on how you actually drive daily. Second, finding the best financing package from our network of five financing companies. Third, coordinating flexible test drives at your location across the Jabodetabek region. Fourth, assisting with trade-ins to maximize the value of your current vehicle as down payment.'
                    : 'Peran kami mencakup empat hal. Pertama, memandu pemilihan model berdasarkan bagaimana Anda benar-benar berkendara setiap hari. Kedua, menemukan paket pembiayaan terbaik dari jaringan lima perusahaan pembiayaan kami. Ketiga, mengkoordinasikan test drive fleksibel di lokasi Anda di seluruh wilayah Jabodetabek. Keempat, membantu trade-in untuk memaksimalkan nilai mobil Anda saat ini sebagai uang muka.'; ?></p>

                <p><?= $lang === 'en'
                    ? 'Because the purchase itself runs through Geely Indonesia\'s official dealer network, the manufacturer\'s warranty applies in full — so you get the personal attention of a consultant plus the protection of an official dealer. We are transparent about this: we earn a referral fee from the dealer, but our role is to represent your interests, not the dealer\'s.'
                    : 'Karena pembelian itu sendiri berjalan melalui jaringan dealer resmi Geely Indonesia, garansi pabrikan berlaku penuh — sehingga Anda mendapatkan perhatian personal seorang konsultan plus perlindungan dealer resmi. Kami transparan soal ini: kami menerima fee rujukan dari dealer, tetapi peran kami adalah mewakili kepentingan Anda, bukan dealer.'; ?></p>

                <h2><?= $lang === 'en' ? 'Meet Your Consultant' : 'Kenalan dengan Konsultan Anda' ?></h2>
                <div class="card" style="display:flex; align-items:center; gap:1.25rem;">
                    <div style="display:inline-flex; align-items:center; justify-content:center; width:5rem; height:5rem; border-radius:9999px; background:linear-gradient(135deg, var(--primary), #14b8a6); color:var(--primary-foreground); font-family:var(--font-display); font-size:1.5rem; font-weight:900; flex-shrink:0;">
                        <?= e(strtoupper(mb_substr(BUSINESS['pic'], 0, 1))); ?>
                    </div>
                    <div>
                        <h3 class="font-display text-lg font-bold"><?= e(BUSINESS['pic']); ?></h3>
                        <p style="font-size:0.875rem; color:var(--muted-foreground);"><?= e($lang === 'en' ? BUSINESS['role_en'] : BUSINESS['role_id']); ?> · <?= e(BUSINESS['region_id']); ?></p>
                        <p style="margin-top:0.5rem; font-size:0.875rem;"><?= $lang === 'en' ? 'Available every day, 08:00–20:00 WIB.' : 'Tersedia setiap hari, 08.00–20.00 WIB.'; ?></p>
                        <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-sm" style="margin-top:0.75rem;">Chat Sekarang</a>
                    </div>
                </div>

                <h2><?= $lang === 'en' ? 'Our Service Area' : 'Wilayah Layanan Kami' ?></h2>
                <p><?= $lang === 'en' ? 'We serve Bogor (city and regency), Depok, Jakarta, Tangerang, and Bekasi — including Sentul, Cibinong, Cibubur, BSD, and surrounding areas.' : 'Kami melayani Bogor (Kota dan Kabupaten), Depok, Jakarta, Tangerang, dan Bekasi — termasuk Sentul, Cibinong, Cibubur, BSD, dan sekitarnya.'; ?></p>

                <h2><?= $lang === 'en' ? 'Independence Disclaimer' : 'Klarifikasi Independensi' ?></h2>
                <p><?= e($lang === 'en' ? $INDEPENDENCE_DISCLAIMER['en'] : $INDEPENDENCE_DISCLAIMER['id']); ?></p>
            </div>
        </div>
    </section>
</main>
<?php page_footer(); ?>
