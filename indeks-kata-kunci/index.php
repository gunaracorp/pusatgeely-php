<?php
/** Indeks Kata Kunci — searchable list of 2.656 keywords */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();

page_header([
    'active' => 'keywords',
    'title' => t('keywords', 'title'),
    'description' => t('keywords', 'subtitle'),
    'canonical' => SITE_URL . '/indeks-kata-kunci',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('keywords', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('keywords', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('keywords', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <!-- Search box -->
            <div style="position:relative; max-width:36rem; margin:0 auto 2rem;">
                <input type="search" class="input" data-keyword-search placeholder="<?= e(t('keywords', 'searchPlaceholder')); ?>" style="padding-left:2.5rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18" style="position:absolute; left:0.875rem; top:50%; transform:translateY(-50%); color:var(--muted-foreground); pointer-events:none;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <p style="text-align:center; font-size:0.875rem; color:var(--muted-foreground);">
                <span data-keyword-count><?= number_format(count($SEO_KEYWORDS)); ?></span> <?= e(t('keywords', 'count')); ?>
            </p>

            <p data-keyword-no-result style="display:none; text-align:center; margin-top:1.5rem; color:var(--muted-foreground);"><?= e(t('keywords', 'noResults')); ?></p>

            <!-- Keyword list -->
            <ul data-keyword-list style="margin-top:2rem; list-style:none; display:grid; grid-template-columns:1fr; gap:0.5rem; max-width:48rem; margin-inline:auto;">
                <?php foreach ($SEO_KEYWORDS as $kw): $label = is_array($kw) ? ($kw['display'] ?? $kw['keyword'] ?? '') : $kw; $href = is_array($kw) ? ($kw['href'] ?? '#') : '#'; ?>
                <li data-keyword="<?= e(strtolower($label)); ?>">
                    <a href="<?= e($href); ?>" style="display:flex; align-items:center; gap:0.5rem; padding:0.5rem 0.75rem; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--card); font-size:0.875rem; text-decoration:none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14" style="color:var(--primary); flex-shrink:0;"><polyline points="9 18 15 12 9 6"/></svg>
                        <?= e($label); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
</main>
<?php page_footer(); ?>
