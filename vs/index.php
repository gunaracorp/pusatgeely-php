<?php
/** VS (Comparison) router — /vs/{slug}
 *  Also handles /vs/ (list).
 */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$slug = $_GET['slug'] ?? '';

if ($slug) {
    // ── Comparison detail ──
    $compare = null;
    foreach ($COMPARES as $c) if ($c['slug'] === $slug) { $compare = $c; break; }

    if (!$compare) {
        http_response_code(404);
        require __DIR__ . '/../404.php';
        exit;
    }

    page_header([
        'active' => 'compare',
        'title' => $compare['title'][$lang] ?? $compare['title']['id'] ?? $compare['slug'],
        'description' => $compare['excerpt'][$lang] ?? $compare['excerpt']['id'] ?? '',
        'canonical' => SITE_URL . '/vs/' . $slug,
        'jsonLd' => [
            breadcrumb_schema([
                ['name' => 'Beranda', 'url' => SITE_URL],
                ['name' => 'Perbandingan', 'url' => SITE_URL . '/vs'],
                ['name' => $compare['title']['id'] ?? $compare['slug'], 'url' => SITE_URL . '/vs/' . $slug],
            ]),
        ],
    ]);
    ?>
    <main>
        <section class="hero bg-grid" style="padding-block:3rem 2rem;">
            <div class="container" style="max-width:56rem;">
                <?php render_breadcrumbs([
                    ['name' => 'Beranda', 'url' => '/'],
                    ['name' => 'Perbandingan', 'url' => '/vs'],
                    ['name' => $compare['title']['id'] ?? $compare['slug'], 'url' => '/vs/' . $slug],
                ]); ?>
                <span class="hero-eyebrow" style="margin-top:1rem;"><?= e(t('vs', 'eyebrow')); ?></span>
                <h1 class="font-display" style="margin-top:1rem; font-size:clamp(1.75rem,4vw,2.5rem); font-weight:800; letter-spacing:-0.025em; line-height:1.2;"><?= e($compare['title'][$lang] ?? $compare['title']['id']); ?></h1>
                <?php if (!empty($compare['excerpt'])): ?>
                <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e($compare['excerpt'][$lang] ?? $compare['excerpt']['id']); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <section class="section">
            <div class="container" style="max-width:56rem;">
                <?php if (!empty($compare['rows'])): ?>
                <table class="compare-table">
                    <thead>
                        <tr>
                            <th><?= $lang === 'en' ? 'Aspect' : 'Aspek'; ?></th>
                            <?php foreach ($compare['cars'] ?? [['name' => 'A'], ['name' => 'B']] as $car): ?>
                            <th><?= e($car['name'][$lang] ?? $car['name']['id'] ?? $car['name'] ?? ''); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($compare['rows'] as $row): ?>
                    <tr>
                        <td class="label-col"><?= e($row['label'][$lang] ?? $row['label']['id'] ?? ''); ?></td>
                        <?php foreach ($row['values'] ?? $row['cars'] ?? [] as $val): ?>
                        <td><?= e(is_array($val) ? ($val[$lang] ?? $val['id'] ?? '') : $val); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if (!empty($compare['verdict'])): ?>
                <div class="card" style="margin-top:2rem; background:linear-gradient(135deg, rgba(26,163,126,0.1), var(--card)); border-color:var(--primary);">
                    <h3 class="font-display text-lg font-bold"><?= $lang === 'en' ? 'Our Verdict' : 'Putusan Kami' ?></h3>
                    <p style="margin-top:0.5rem;"><?= e($compare['verdict'][$lang] ?? $compare['verdict']['id']); ?></p>
                </div>
                <?php endif; ?>

                <div style="margin-top:2rem; text-align:center;">
                    <a href="<?= e(wa_link('Halo Pusat Geely, saya baru baca perbandingan "' . ($compare['title']['id'] ?? '') . '" dan ingin diskusi.')); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">Chat Diskusi</a>
                </div>
            </div>
        </section>
    </main>
    <?php page_footer(); ?>
    exit;
}

// ── Comparison list ──
page_header([
    'active' => 'compare',
    'title' => t('vs', 'title'),
    'description' => t('vs', 'subtitle'),
    'canonical' => SITE_URL . '/vs',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('vs', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('vs', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('vs', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div style="display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-2">
                <?php foreach ($COMPARES as $c): ?>
                <a href="/vs/<?= e($c['slug']); ?>" class="card card-hover" style="text-decoration:none;">
                    <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem; color:var(--muted-foreground);">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14" style="color:var(--primary);"><polyline points="14.5 17.5 3 6 3 3 6 3 17.5 14.5"/><line x1="13" y1="19" x2="19" y2="13"/><line x1="16" y1="16" x2="20" y2="20"/><line x1="19" y1="21" x2="21" y2="19"/></svg>
                        <span>Perbandingan</span>
                    </div>
                    <h3 class="font-display" style="margin-top:0.5rem; font-size:1.0625rem; font-weight:700; line-height:1.3;"><?= e($c['title'][$lang] ?? $c['title']['id']); ?></h3>
                    <?php if (!empty($c['excerpt'])): ?>
                    <p style="margin-top:0.5rem; font-size:0.875rem; color:var(--muted-foreground); line-height:1.5;"><?= e($c['excerpt'][$lang] ?? $c['excerpt']['id']); ?></p>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php page_footer(); ?>
