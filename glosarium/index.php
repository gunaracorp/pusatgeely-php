<?php
/** Glosarium page */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();

page_header([
    'active' => 'glosarium',
    'title' => t('glossary', 'title'),
    'description' => t('glossary', 'subtitle'),
    'canonical' => SITE_URL . '/glosarium',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('glossary', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('glossary', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('glossary', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php foreach ($GLOSSARY_CATEGORIES as $cat): ?>
                <h2 class="section-title" style="font-size:1.5rem; margin-top:2rem; padding-top:1.5rem; border-top:1px solid var(--border);"><?= e($cat['label'][$lang]); ?></h2>
                <div style="margin-top:1rem; display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-2">
                    <?php foreach ($GLOSSARY as $term): if ($term['category'] !== $cat['key']) continue; ?>
                    <div class="card card-hover">
                        <h3 class="font-display text-lg font-bold"><?= e($term['term'][$lang]); ?></h3>
                        <p style="margin-top:0.5rem; font-size:0.875rem; line-height:1.6; color:var(--muted-foreground);"><?= e($term['definition'][$lang]); ?></p>
                        <?php if (!empty($term['related'])): ?>
                        <div style="margin-top:0.75rem; display:flex; flex-wrap:wrap; gap:0.375rem;">
                            <?php foreach ($term['related'] as $r): ?>
                            <a href="<?= e($r['href']); ?>" class="badge badge-outline" style="text-decoration:none;"><?= e($r['label'][$lang]); ?> →</a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php page_footer(); ?>
