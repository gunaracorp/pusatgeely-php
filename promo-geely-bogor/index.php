<?php
/** Promo page */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya tertarik dengan promo yang tersedia.');

page_header([
    'active' => 'promo',
    'title' => t('promo', 'title'),
    'description' => t('promo', 'subtitle'),
    'canonical' => SITE_URL . '/promo-geely-bogor',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('promo', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('promo', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('promo', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div style="display:grid; grid-template-columns:1fr; gap:1.5rem;" class="lg:grid-cols-2">
                <?php foreach ($PROMO_PROGRAMS as $promo): ?>
                <div class="card card-hover" style="border-color:<?= e($promo['accent']); ?>40;">
                    <div style="display:flex; align-items:baseline; justify-content:space-between; gap:0.75rem;">
                        <h3 class="font-display text-lg font-bold"><?= e($promo['finance']); ?></h3>
                        <span class="badge badge-outline" style="border-color:<?= e($promo['accent']); ?>; color:<?= e($promo['accent']); ?>;">
                            <?= e($promo['badge'][$lang] ?? $promo['badge']['id']); ?>
                        </span>
                    </div>
                    <p style="margin-top:0.5rem; font-size:0.875rem; color:var(--muted-foreground);"><?= e($promo['program'][$lang] ?? $promo['program']['id']); ?></p>

                    <?php if (!empty($promo['period'])): ?>
                    <p style="margin-top:0.5rem; font-size:0.75rem; color:var(--muted-foreground); display:inline-flex; align-items:center; gap:0.375rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <?= e($promo['period'][$lang] ?? $promo['period']['id']); ?>
                    </p>
                    <?php endif; ?>

                    <?php if (!empty($promo['highlights'])): ?>
                    <ul style="margin-top:1rem; list-style:none; display:flex; flex-direction:column; gap:0.375rem;">
                        <?php foreach ($promo['highlights'] as $h): ?>
                        <li style="font-size:0.8125rem; display:flex; gap:0.5rem;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14" style="color:var(--primary); flex-shrink:0; margin-top:0.125rem;"><polyline points="20 6 9 17 4 12"/></svg>
                            <?= e($h[$lang] ?? $h['id']); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($promo['requirements'])): ?>
                    <details style="margin-top:0.875rem;">
                        <summary style="font-size:0.8125rem; font-weight:600; cursor:pointer; color:var(--primary);"><?= $lang === 'en' ? 'Requirements' : 'Persyaratan'; ?></summary>
                        <ul style="margin-top:0.5rem; list-style:disc; margin-left:1.25rem; font-size:0.8125rem; color:var(--muted-foreground);">
                            <?php foreach ($promo['requirements'] as $r): ?>
                            <li><?= e($r[$lang] ?? $r['id']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </details>
                    <?php endif; ?>

                    <?php if (!empty($promo['note'])): ?>
                    <p style="margin-top:0.75rem; font-size:0.75rem; color:var(--muted-foreground); padding:0.625rem; background:var(--muted); border-radius:var(--radius-md);">
                        <?= e($promo['note'][$lang] ?? $promo['note']['id']); ?>
                    </p>
                    <?php endif; ?>

                    <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid var(--border); display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <a href="/assets/promos/<?= e(basename($promo['pdf'])); ?>" target="_blank" class="btn btn-outline btn-sm">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            <?= e(t('promo', 'pdf')); ?>
                        </a>
                        <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Pakai Paket Ini</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if (!empty($PROMO_DISCLAIMER)): ?>
            <p style="margin-top:1.5rem; font-size:0.75rem; color:var(--muted-foreground); text-align:center;">
                <?= e($PROMO_DISCLAIMER[$lang] ?? $PROMO_DISCLAIMER['id']); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php page_footer(); ?>
