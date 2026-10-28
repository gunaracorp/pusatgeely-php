<?php
/** Artikel list — /artikel/
 *  Also handles /artikel/{slug} via ?slug= URL parameter (from .htaccess rewrite).
 */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();

$slug = $_GET['slug'] ?? '';

if ($slug) {
    // ── Article detail ──
    $article = null;
    foreach ($ARTICLES as $a) if ($a['slug'] === $slug) { $article = $a; break; }

    if (!$article) {
        http_response_code(404);
        require __DIR__ . '/../404.php';
        exit;
    }

    page_header([
        'active' => 'artikel',
        'title' => $article['title'][$lang] ?? $article['title']['id'],
        'description' => $article['excerpt'][$lang] ?? $article['excerpt']['id'],
        'canonical' => SITE_URL . '/artikel/' . $slug,
        'ogImage' => SITE_URL . $article['image'],
        'type' => 'article',
        'publishedTime' => $article['date'],
        'jsonLd' => [
            breadcrumb_schema([
                ['name' => 'Beranda', 'url' => SITE_URL],
                ['name' => 'Artikel', 'url' => SITE_URL . '/artikel'],
                ['name' => $article['title']['id'], 'url' => SITE_URL . '/artikel/' . $slug],
            ]),
            article_schema($article),
        ],
    ]);
    ?>
    <main>
        <article>
            <section class="hero bg-grid" style="padding-block:3rem 2rem;">
                <div class="container" style="max-width:48rem;">
                    <?php render_breadcrumbs([
                        ['name' => 'Beranda', 'url' => '/'],
                        ['name' => 'Artikel', 'url' => '/artikel'],
                        ['name' => $article['tag'][$lang] ?? $article['tag']['id'], 'url' => '/artikel'],
                    ]); ?>
                    <span class="badge badge-primary" style="margin-top:1rem;"><?= e($article['tag'][$lang] ?? $article['tag']['id']); ?></span>
                    <h1 class="font-display" style="margin-top:1rem; font-size:clamp(1.75rem,4vw,2.5rem); font-weight:800; letter-spacing:-0.025em; line-height:1.2;"><?= e($article['title'][$lang] ?? $article['title']['id']); ?></h1>
                    <p style="margin-top:0.75rem; font-size:1.0625rem; color:var(--muted-foreground);"><?= e($article['excerpt'][$lang] ?? $article['excerpt']['id']); ?></p>
                    <p style="margin-top:0.75rem; font-size:0.8125rem; color:var(--muted-foreground);">
                        <?= $lang === 'en' ? 'Published' : 'Dipublikasikan'; ?>: <?= e(date('j F Y', strtotime($article['date']))); ?>
                    </p>
                </div>
            </section>

            <section class="section">
                <div class="container" style="max-width:48rem;">
                    <img src="<?= e($article['image']); ?>" alt="<?= e($article['title'][$lang] ?? $article['title']['id']); ?>" style="width:100%; aspect-ratio:16/9; object-fit:cover; border-radius:var(--radius-xl); margin-bottom:2rem;">

                    <div class="article-body">
                        <?php foreach ($article['sections'] as $section): ?>
                            <?php if (!empty($section['h'])): ?>
                            <h2><?= e($section['h'][$lang] ?? $section['h']['id']); ?></h2>
                            <?php endif; ?>
                            <?php foreach ($section['p'] as $p): ?>
                            <p><?= e($p[$lang] ?? $p['id']); ?></p>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- CTA -->
                    <div class="card" style="margin-top:3rem; text-align:center; background:linear-gradient(135deg, rgba(26,163,126,0.1), var(--card)); border-color:var(--primary);">
                        <h3 class="font-display text-xl font-bold"><?= $lang === 'en' ? 'Ready to discuss further?' : 'Siap diskusi lebih lanjut?' ?></h3>
                        <p style="margin-top:0.5rem; color:var(--muted-foreground);"><?= $lang === 'en' ? 'Chat us on WhatsApp for personalized guidance.' : 'Chat WhatsApp untuk panduan personal.'; ?></p>
                        <a href="<?= e(wa_link('Halo Pusat Geely, saya baru saja baca artikel "' . ($article['title']['id']) . '" dan ingin tanya lebih lanjut.')); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg" style="margin-top:1rem;">Chat WhatsApp</a>
                    </div>

                    <!-- Other articles -->
                    <h2 class="section-title" style="margin-top:3rem; font-size:1.5rem;"><?= $lang === 'en' ? 'Other Articles' : 'Artikel Lainnya' ?></h2>
                    <div style="margin-top:1.5rem; display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-2">
                        <?php $count = 0; foreach ($ARTICLES as $a): if ($a['slug'] === $slug) continue; if (++$count > 4) break; ?>
                        <a href="/artikel/<?= e($a['slug']); ?>" class="card card-hover" style="text-decoration:none;">
                            <img src="<?= e($a['image']); ?>" alt="<?= e($a['title'][$lang] ?? $a['title']['id']); ?>" loading="lazy" style="width:100%; aspect-ratio:16/9; object-fit:cover; border-radius:var(--radius-md);">
                            <span class="badge badge-outline" style="margin-top:0.75rem;"><?= e($a['tag'][$lang] ?? $a['tag']['id']); ?></span>
                            <h3 class="font-display" style="margin-top:0.5rem; font-size:1rem; font-weight:700; line-height:1.3;"><?= e($a['title'][$lang] ?? $a['title']['id']); ?></h3>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </article>
    </main>
    <?php
    page_footer();
    exit;
}

// ── Article list ──
page_header([
    'active' => 'artikel',
    'title' => t('artikel', 'title'),
    'description' => t('artikel', 'subtitle'),
    'canonical' => SITE_URL . '/artikel',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('artikel', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('artikel', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('artikel', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div style="display:grid; grid-template-columns:1fr; gap:1.5rem;" class="md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($ARTICLES as $a): ?>
                <a href="/artikel/<?= e($a['slug']); ?>" class="card card-hover" style="text-decoration:none; padding:0; overflow:hidden;">
                    <img src="<?= e($a['image']); ?>" alt="<?= e($a['title'][$lang] ?? $a['title']['id']); ?>" loading="lazy" style="width:100%; aspect-ratio:16/9; object-fit:cover;">
                    <div style="padding:1.25rem;">
                        <div style="display:flex; align-items:center; gap:0.5rem; font-size:0.75rem; color:var(--muted-foreground);">
                            <span class="badge badge-primary"><?= e($a['tag'][$lang] ?? $a['tag']['id']); ?></span>
                            <span><?= e(date('j M Y', strtotime($a['date']))); ?></span>
                        </div>
                        <h3 class="font-display" style="margin-top:0.75rem; font-size:1.0625rem; font-weight:700; line-height:1.3;"><?= e($a['title'][$lang] ?? $a['title']['id']); ?></h3>
                        <p style="margin-top:0.5rem; font-size:0.875rem; color:var(--muted-foreground); line-height:1.5;"><?= e($a['excerpt'][$lang] ?? $a['excerpt']['id']); ?></p>
                        <span style="margin-top:0.75rem; display:inline-flex; align-items:center; gap:0.25rem; font-size:0.8125rem; color:var(--primary); font-weight:600;">
                            Baca selengkapnya →
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php page_footer(); ?>
