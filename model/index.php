<?php
/**
 * Model detail router — /model/{slug}
 * Lookup model + detail, render page or 404.
 */

require_once __DIR__ . '/../includes/page-shell.php';

$slug = $_GET['slug'] ?? '';
$model = null;
$detail = null;

foreach ($MODELS as $m) {
    if ($m['id'] === $slug) { $model = $m; break; }
}
if (!empty($MODEL_DETAILS)) {
    foreach ($MODEL_DETAILS as $d) {
        if ($d['id'] === $slug) { $detail = $d; break; }
    }
}

if (!$model) {
    http_response_code(404);
    require __DIR__ . '/../404.php';
    exit;
}

$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya tertarik dengan ' . $model['name'] . '. Bisa info lebih lanjut?');

page_header([
    'active' => 'models',
    'title' => $model['name'] . ' — Harga, Spesifikasi & Test Drive di Bogor',
    'description' => $model['blurb'][$lang] . ' Harga mulai ' . format_juta($model['priceFrom']) . '. Test drive & simulasi kredit di Bogor & Jabodetabek.',
    'canonical' => SITE_URL . '/model/' . $slug,
    'ogImage' => SITE_URL . $model['image'],
    'jsonLd' => [
        breadcrumb_schema([
            ['name' => 'Beranda', 'url' => SITE_URL],
            ['name' => 'Model', 'url' => SITE_URL . '/#model'],
            ['name' => $model['name'], 'url' => SITE_URL . '/model/' . $slug],
        ]),
        car_schema($model),
    ],
]);

$powertrainLabel = $POWERTRAIN_LABEL[$model['powertrain']] ?? ['id' => '', 'en' => ''];
?>

<main>
    <section class="hero bg-grid">
        <div class="container">
            <?php render_breadcrumbs([
                ['name' => 'Beranda', 'url' => '/'],
                ['name' => 'Model', 'url' => '/#model'],
                ['name' => $model['name'], 'url' => '/model/' . $slug],
            ]); ?>

            <div style="margin-top:2rem; display:grid; grid-template-columns:1fr; gap:2rem; align-items:center;" class="lg:grid-cols-2">
                <div>
                    <span class="hero-eyebrow"><?= e($powertrainLabel[$lang]); ?></span>
                    <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2.25rem,5vw,3.5rem); line-height:1.05; letter-spacing:-0.025em; font-weight:800;"><?= e($model['name']); ?></h1>
                    <?php if ($detail): ?>
                    <p style="margin-top:0.75rem; font-size:1.0625rem; color:var(--accent-foreground);"><?= e($detail['tagline'][$lang]); ?></p>
                    <?php endif; ?>

                    <div style="margin-top:1.5rem; display:flex; flex-wrap:wrap; gap:0.625rem;">
                        <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                            Chat WhatsApp
                        </a>
                        <a href="/#test-drive" class="btn btn-primary btn-lg">Booking Test Drive</a>
                    </div>
                </div>

                <div style="position:relative; aspect-ratio:16/10; border-radius:var(--radius-xl); overflow:hidden; border:1px solid var(--border);">
                    <img src="<?= e($model['image']); ?>" alt="<?= e($model['name']); ?>" style="width:100%; height:100%; object-fit:cover;">
                    <?php if (!empty($model['badge'])): ?>
                    <span class="badge badge-primary" style="position:absolute; top:1rem; left:1rem;"><?= e($model['badge'][$lang]); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ($detail): ?>
    <section class="section">
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Overview' : 'Sekilas' ?></h2>
            <div class="article-body" style="margin-top:1.5rem;">
                <?php foreach ($detail['overview'][$lang] as $para): ?>
                <p><?= e($para); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section bg-secondary">
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Key Specifications' : 'Spesifikasi Kunci' ?></h2>
            <table class="price-table" style="margin-top:1.5rem;">
                <tbody>
                <?php foreach ($detail['specs'] as $spec): ?>
                <tr>
                    <td class="label-col" style="width:40%;"><?= e($spec['label'][$lang]); ?></td>
                    <td><strong><?= e($spec['value'][$lang]); ?></strong></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Highlights' : 'Keunggulan Utama' ?></h2>
            <ul style="margin-top:1.5rem; list-style:none; display:flex; flex-direction:column; gap:0.875rem;">
                <?php foreach ($detail['highlights'] as $h): ?>
                <li style="display:flex; gap:0.75rem; align-items:flex-start;">
                    <span style="display:inline-flex; align-items:center; justify-content:center; width:1.75rem; height:1.75rem; border-radius:9999px; background:var(--primary); color:var(--primary-foreground); flex-shrink:0;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><polyline points="20 6 9 17 4 12"/></svg>
                    </span>
                    <span style="padding-top:0.125rem;"><?= e($h[$lang]); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <?php if (!empty($detail['faq'])): ?>
    <section class="section bg-secondary" data-faq-group>
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Common Questions' : 'Pertanyaan Umum' ?></h2>
            <div style="margin-top:1.5rem;">
                <?php foreach ($detail['faq'] as $f): ?>
                <div class="faq-item" data-faq-item>
                    <button type="button" class="faq-question" data-faq-question>
                        <?= e($f['q'][$lang]); ?>
                        <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-answer"><p><?= e($f['a'][$lang]); ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="section">
        <div class="container" style="max-width:48rem;">
            <div class="card" style="border-color:var(--primary); background:linear-gradient(135deg, rgba(26,163,126,0.1), var(--card));">
                <h3 class="font-display text-lg font-bold"><?= $lang === 'en' ? 'Who is this car for?' : 'Untuk siapa mobil ini?' ?></h3>
                <p style="margin-top:0.5rem;"><?= e($detail['fitFor'][$lang]); ?></p>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Variants & pricing -->
    <section class="section bg-secondary">
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Variants & Pricing' : 'Varian & Harga' ?></h2>
            <table class="price-table" style="margin-top:1.5rem;">
                <thead>
                    <tr>
                        <th><?= $lang === 'en' ? 'Variant' : 'Varian' ?></th>
                        <th style="text-align:right;"><?= $lang === 'en' ? 'Price (OTR)' : 'Harga (OTR)' ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($model['variants'] as $v): ?>
                <tr>
                    <td><strong><?= e($v['label']); ?></strong></td>
                    <td style="text-align:right;"><?= e(format_idr($v['price'])); ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p style="margin-top:1rem; font-size:0.75rem; color:var(--muted-foreground);">
                <?= e($lang === 'en' ? $PRICE_DISCLAIMER['en'] : $PRICE_DISCLAIMER['id']); ?>
            </p>
        </div>
    </section>

    <!-- Other models -->
    <section class="section">
        <div class="container">
            <?php render_section_header($lang === 'en' ? 'Other Models' : 'Model Lainnya', $lang === 'en' ? 'Explore the full Geely lineup' : 'Jelajahi lineup Geely lengkap'); ?>
            <div class="model-grid" style="margin-top:2.5rem;">
                <?php foreach ($MODELS as $m): if ($m['id'] !== $slug): render_model_card($m); endif; endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php page_footer(); ?>
