<?php
/** Harga page */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya ingin tanya harga terbaru dan penawaran terbaik.');

page_header([
    'active' => 'harga',
    'title' => t('harga', 'title'),
    'description' => t('harga', 'subtitle'),
    'canonical' => SITE_URL . '/harga-mobil-geely-bogor',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('harga', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('harga', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('harga', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php foreach ($MODELS as $m): $detail = null;
                foreach ($MODEL_DETAILS ?? [] as $d) if ($d['id'] === $m['id']) { $detail = $d; break; }
            ?>
            <div class="card" style="margin-bottom:1.5rem;">
                <div style="display:flex; align-items:baseline; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                    <div>
                        <h2 class="font-display text-2xl font-bold"><?= e($m['name']); ?></h2>
                        <p style="font-size:0.875rem; color:var(--muted-foreground); margin-top:0.25rem;"><?= e($m['blurb'][$lang]); ?></p>
                    </div>
                    <a href="/model/<?= e($m['id']); ?>" class="btn btn-outline btn-sm">Lihat Detail →</a>
                </div>

                <table class="price-table" style="margin-top:1rem;">
                    <thead>
                        <tr>
                            <th><?= $lang === 'en' ? 'Variant' : 'Varian' ?></th>
                            <th style="text-align:right;"><?= $lang === 'en' ? 'OTR Price' : 'Harga OTR' ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($m['variants'] as $v): ?>
                    <tr>
                        <td><strong><?= e($v['label']); ?></strong></td>
                        <td style="text-align:right; font-family:var(--font-display); font-weight:700; color:var(--primary);"><?= e(format_idr($v['price'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php if (!empty($m['colors'])): ?>
                <div style="margin-top:1rem; display:flex; align-items:center; gap:0.75rem; flex-wrap:wrap;">
                    <span style="font-size:0.8125rem; color:var(--muted-foreground);"><?= $lang === 'en' ? 'Colors:' : 'Warna:'; ?></span>
                    <div class="color-swatches" style="margin-top:0;">
                    <?php foreach ($m['colors'] as $color): ?>
                        <span class="color-swatch" style="background:<?= e($color['swatch']); ?>;" title="<?= e($color['label'][$lang]); ?>"></span>
                        <span style="font-size:0.75rem; color:var(--muted-foreground); margin-right:0.5rem; align-self:center;"><?= e($color['label'][$lang]); ?></span>
                    <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($detail): ?>
                <div style="margin-top:1rem; display:flex; flex-wrap:wrap; gap:0.5rem;">
                    <?php foreach ($detail['specs'] as $spec): ?>
                    <span class="badge badge-outline"><?= e($spec['label'][$lang]); ?>: <?= e($spec['value'][$lang]); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <p style="margin-top:1.5rem; font-size:0.75rem; color:var(--muted-foreground);">
                <?= e($lang === 'en' ? $PRICE_DISCLAIMER['en'] : $PRICE_DISCLAIMER['id']); ?>
            </p>

            <div style="margin-top:2rem; text-align:center;">
                <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">Tanya Penawaran Terbaik</a>
            </div>
        </div>
    </section>
</main>
<?php page_footer(); ?>
