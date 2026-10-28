<?php
/**
 * Landing page router — /{slug}
 * Looks up slug in ALL_LANDING_PAGES (44 programmatic landing pages).
 * If not found → 404.
 */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$slug = $_GET['slug'] ?? '';

// Whitelist of static routes that should NOT be caught by the landing router
// (they have their own index.php files)
$staticRoutes = [
    'kontak', 'tentang', 'glosarium', 'artikel', 'vs', 'model', 'admin', 'api',
    'harga-mobil-geely-bogor', 'promo-geely-bogor', 'indeks-kata-kunci',
    'sitemap.xml', 'robots.txt', 'manifest.json', 'feed.xml', 'llms.txt', 'llms-full.txt',
    'assets',
];

if (in_array($slug, $staticRoutes, true) || !$slug) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

// Find the landing page
$landing = null;
foreach ($ALL_LANDING_PAGES as $lp) {
    if (($lp['slug'] ?? '') === $slug) { $landing = $lp; break; }
}

if (!$landing) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

// ── Render landing page ──
$waText = 'Halo Pusat Geely, saya tertarik dengan "' . ($landing['title'][$lang] ?? $landing['title']['id'] ?? $slug) . '".';
$waLink = wa_link($waText);

page_header([
    'active' => '',
    'title' => $landing['title'][$lang] ?? $landing['title']['id'] ?? 'Pusat Geely',
    'description' => $landing['excerpt'][$lang] ?? $landing['excerpt']['id'] ?? ($landing['description'][$lang] ?? $landing['description']['id'] ?? ''),
    'canonical' => SITE_URL . '/' . $slug,
    'jsonLd' => !empty($landing['faq']) ? [[
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question',
            'name' => $f['q'][$lang] ?? $f['q']['id'] ?? '',
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a'][$lang] ?? $f['a']['id'] ?? ''],
        ], $landing['faq']),
    ]] : [],
]);
?>
<main>
    <section class="hero bg-grid">
        <div class="container">
            <?php if (!empty($landing['eyebrow'])): ?>
            <span class="hero-eyebrow"><?= e($landing['eyebrow'][$lang] ?? $landing['eyebrow']['id']); ?></span>
            <?php endif; ?>
            <h1 class="font-display" style="margin-top:1rem;"><?= e($landing['title'][$lang] ?? $landing['title']['id']); ?></h1>
            <?php if (!empty($landing['excerpt']) || !empty($landing['description'])): ?>
            <p class="hero-subtitle"><?= e(($landing['excerpt'][$lang] ?? $landing['excerpt']['id'] ?? '') ?: ($landing['description'][$lang] ?? $landing['description']['id'] ?? '')); ?></p>
            <?php endif; ?>

            <div class="hero-cta">
                <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                    Chat WhatsApp
                </a>
                <a href="/#test-drive" class="btn btn-outline btn-lg">Booking Test Drive</a>
            </div>
        </div>
    </section>

    <?php if (!empty($landing['sections'])): ?>
    <section class="section">
        <div class="container" style="max-width:48rem;">
            <div class="article-body">
                <?php foreach ($landing['sections'] as $section): ?>
                    <?php if (!empty($section['h'])): ?>
                    <h2><?= e($section['h'][$lang] ?? $section['h']['id']); ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($section['p'])): foreach ($section['p'] as $p): ?>
                    <p><?= e($p[$lang] ?? $p['id']); ?></p>
                    <?php endforeach; endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($landing['faq'])): ?>
    <section class="section bg-secondary" data-faq-group>
        <div class="container" style="max-width:48rem;">
            <h2 class="section-title"><?= $lang === 'en' ? 'Frequently Asked Questions' : 'Pertanyaan yang Sering Diajukan' ?></h2>
            <div style="margin-top:1.5rem;">
                <?php foreach ($landing['faq'] as $f): ?>
                <div class="faq-item" data-faq-item>
                    <button type="button" class="faq-question" data-faq-question>
                        <?= e($f['q'][$lang] ?? $f['q']['id']); ?>
                        <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-answer"><p><?= e($f['a'][$lang] ?? $f['a']['id']); ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($landing['related'])): ?>
    <section class="section">
        <div class="container">
            <h2 class="section-title"><?= $lang === 'en' ? 'Related Pages' : 'Halaman Terkait' ?></h2>
            <div style="margin-top:1.5rem; display:flex; flex-wrap:wrap; gap:0.5rem;">
                <?php foreach ($landing['related'] as $r): ?>
                <a href="<?= e($r['href']); ?>" class="badge badge-outline" style="padding:0.5rem 0.875rem; font-size:0.8125rem; text-decoration:none;"><?= e($r['label'][$lang] ?? $r['label']['id'] ?? ''); ?> →</a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="section">
        <div class="container">
            <div class="card" style="text-align:center; background:linear-gradient(135deg, rgba(26,163,126,0.1), var(--card)); border-color:var(--primary);">
                <h3 class="font-display text-2xl font-bold"><?= e(t('cta', 'title')); ?></h3>
                <p style="margin-top:0.5rem; color:var(--muted-foreground);"><?= e(t('cta', 'subtitle')); ?></p>
                <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg" style="margin-top:1rem;">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                    <?= e(t('cta', 'button')); ?>
                </a>
            </div>
        </div>
    </section>
</main>
<?php page_footer(); ?>
