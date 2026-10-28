<?php
/**
 * Site footer — CTA band + sitemap grid + popular searches + legal + digital credits.
 *
 * @param bool   $showCTA   Whether to show the CTA band at top (default true)
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/i18n.php';

$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely! Saya siap diskusi soal Geely saya.');

// Footer sitemap columns
$modelLinks = array_map(fn($m) => ['href' => '/model/' . $m['id'], 'label' => $m['name']], $GLOBALS['MODELS'] ?? []);
$modelLinks[] = ['href' => '/harga-mobil-geely-bogor', 'label' => t('nav', 'harga') . ' & Varian'];

$serviceLinks = [
    ['href' => '/harga-mobil-geely-bogor', 'label' => t('nav', 'harga')],
    ['href' => '/promo-geely-bogor', 'label' => t('nav', 'promo')],
    ['href' => '/#financing', 'label' => t('nav', 'simulator')],
    ['href' => '/#test-drive', 'label' => t('nav', 'testDrive')],
    ['href' => '/tentang', 'label' => t('nav', 'sales')],
];

$insightLinks = [
    ['href' => '/artikel', 'label' => t('nav', 'artikel')],
    ['href' => '/glosarium', 'label' => t('nav', 'glosarium')],
    ['href' => '/vs', 'label' => t('nav', 'compare')],
    ['href' => '/indeks-kata-kunci', 'label' => t('nav', 'keywords')],
    ['href' => '/tentang', 'label' => t('nav', 'about')],
];

$contactRows = [
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>',
        'label' => 'WhatsApp', 'value' => BUSINESS['wa_display'], 'href' => $waLink, 'external' => true,
    ],
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>',
        'label' => 'Email', 'value' => BUSINESS['email'], 'href' => 'mailto:' . BUSINESS['email'], 'external' => false,
    ],
    [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        'label' => 'Instagram', 'value' => BUSINESS['instagram'], 'href' => BUSINESS['instagram_url'], 'external' => true,
    ],
];

$socials = [
    ['label' => 'Instagram', 'href' => BUSINESS['instagram_url'],
     'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>'],
    ['label' => 'Facebook', 'href' => BUSINESS['facebook_url'],
     'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>'],
    ['label' => 'TikTok', 'href' => BUSINESS['tiktok_url'],
     'icon' => '<svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43V8.45a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.12Z"/></svg>'],
    ['label' => 'X (Twitter)', 'href' => BUSINESS['x_url'],
     'icon' => '<svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>'],
];

// Digital support system credits
global $DESIGN_CREDIT, $MANAGEMENT_CREDIT, $TEAM_CREDIT, $CREDIT_LINE;
?>
    <footer class="site-footer" id="kontak">
        <div class="container" style="padding-block: 3.5rem 1.5rem;">
            <!-- CTA Band -->
            <?php if ($showCTA ?? true): ?>
            <div class="footer-cta">
                <div style="display:flex; flex-direction:column; gap:1.25rem;" class="lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="font-display" style="font-size:1.5rem; font-weight:700; letter-spacing:-0.025em; line-height:1.2;">
                            <?= e(t('cta', 'title')) ?>
                        </h2>
                        <p style="max-width:36rem; margin-top:0.375rem; font-size:0.875rem; line-height:1.6; color:var(--muted-foreground);">
                            <?= e(t('cta', 'subtitle')) ?>
                        </p>
                    </div>
                    <div style="display:flex; flex-wrap:wrap; gap:0.75rem; flex-shrink:0;">
                        <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                            <?= e(t('cta', 'button')) ?>
                        </a>
                        <a href="/#test-drive" class="btn btn-outline">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="color:var(--primary);"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
                            <?= e(t('hero', 'ctaPrimary')) ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Sitemap grid -->
            <div class="footer-grid" style="margin-top:3rem;">
                <!-- Brand column -->
                <div>
                    <a href="/" class="brand" aria-label="Pusat Geely" style="display:inline-flex; align-items:center; gap:0.625rem;">
                        <svg viewBox="0 0 48 48" fill="none" aria-hidden="true" width="36" height="36" class="brand-mark">
                            <path d="M24 3 43 13.5v21L24 45 5 34.5v-21L24 3Z" stroke="#1aa37e" stroke-width="2.6" stroke-linejoin="round"/>
                            <path d="M31.5 19.2c-1.6-2.4-4.3-3.9-7.4-3.9-5 0-9 3.9-9 8.7s4 8.7 9 8.7c4.2 0 7.7-2.8 8.7-6.6h-8.2" stroke="currentColor" stroke-width="2.6" stroke-linejoin="round" stroke-linecap="round" fill="none"/>
                        </svg>
                        <span class="font-display" style="font-size:1.125rem; font-weight:700; letter-spacing:-0.025em;">PUSAT<span class="brand-name-primary">GEELY</span></span>
                    </a>
                    <p style="margin-top:1rem; font-size:0.875rem; line-height:1.6; color:var(--muted-foreground);">
                        <?= e(t('footer', 'about')) ?>
                    </p>
                    <p style="margin-top:1rem; display:inline-flex; align-items:center; gap:0.5rem; padding:0.375rem 0.75rem; border:1px solid var(--border); border-radius:9999px; background:var(--card); font-size:0.75rem; font-weight:500;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14" style="color:var(--primary);"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <?= e(BUSINESS['pic']) ?> — <?= e($lang === 'en' ? BUSINESS['role_en'] : BUSINESS['role_id']) ?>
                    </p>
                    <div style="margin-top:1.25rem;">
                        <h3 style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">
                            <?= e(t('footer', 'followLabel')) ?>
                        </h3>
                        <div class="social-icons" style="margin-top:0.75rem;">
                            <?php foreach ($socials as $s): ?>
                            <a href="<?= e($s['href']) ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Pusat Geely — <?= e($s['label']) ?>" title="Pusat Geely — <?= e($s['label']) ?>">
                                <?= $s['icon'] ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Models -->
                <nav class="footer-col" aria-label="<?= e(t('footer', 'modelsTitle')) ?>">
                    <h3><?= e(t('footer', 'modelsTitle')) ?></h3>
                    <ul>
                        <?php foreach ($modelLinks as $link): ?>
                        <li><a href="<?= e($link['href']) ?>"><?= e($link['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <!-- Services -->
                <nav class="footer-col" aria-label="<?= e(t('footer', 'servicesTitle')) ?>">
                    <h3><?= e(t('footer', 'servicesTitle')) ?></h3>
                    <ul>
                        <?php foreach ($serviceLinks as $link): ?>
                        <li><a href="<?= e($link['href']) ?>"><?= e($link['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <!-- Insights -->
                <nav class="footer-col" aria-label="<?= e(t('footer', 'insightsTitle')) ?>">
                    <h3><?= e(t('footer', 'insightsTitle')) ?></h3>
                    <ul>
                        <?php foreach ($insightLinks as $link): ?>
                        <li><a href="<?= e($link['href']) ?>"><?= e($link['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>

                <!-- Contact -->
                <div class="footer-col">
                    <h3><?= e(t('footer', 'contactTitle')) ?></h3>
                    <ul style="gap:0.75rem;">
                        <?php foreach ($contactRows as $row): ?>
                        <li>
                            <a href="<?= e($row['href']) ?>" <?= $row['external'] ? 'target="_blank" rel="noopener noreferrer"' : '' ?> style="display:flex; align-items:center; gap:0.75rem; font-size:0.875rem;">
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:2rem; height:2rem; border-radius:0.5rem; background:var(--accent); color:var(--accent-foreground); flex-shrink:0;"><?= $row['icon'] ?></span>
                                <span>
                                    <span style="display:block; font-size:0.75rem; color:var(--muted-foreground);"><?= e($row['label']) ?></span>
                                    <span style="font-weight:500;"><?= e($row['value']) ?></span>
                                </span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <li style="display:flex; align-items:center; gap:0.75rem; font-size:0.875rem;">
                            <span style="display:inline-flex; align-items:center; justify-content:center; width:2rem; height:2rem; border-radius:0.5rem; background:var(--accent); color:var(--accent-foreground); flex-shrink:0;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </span>
                            <span>
                                <span style="display:block; font-size:0.75rem; color:var(--muted-foreground);"><?= e(t('coverage', 'hoursLabel')) ?></span>
                                <span style="font-weight:500;"><?= e($lang === 'en' ? BUSINESS['hours_en'] : BUSINESS['hours_id']) ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Popular searches -->
            <nav aria-label="<?= e(t('footer', 'popularTitle')) ?>" style="margin-top:2.5rem; border-top:1px solid var(--border); padding-top:1.5rem;">
                <h3 style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);">
                    <?= e(t('footer', 'popularTitle')) ?>
                </h3>
                <ul class="popular-searches">
                    <?php foreach (array_slice($GLOBALS['POPULAR_SEARCHES'] ?? [], 0, 35) as $ps): ?>
                    <li><a href="<?= e($ps['href']) ?>">#<?= e($ps['label']) ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="/indeks-kata-kunci" style="border-color:var(--primary); color:var(--primary); font-weight:600; background:rgba(26,163,126,0.1);">#lihat-semua-2.600+kata-kunci →</a></li>
                    <li><a href="/artikel">#artikel-panduan</a></li>
                    <li><a href="/glosarium">#glosarium-otomotif</a></li>
                </ul>
            </nav>

            <!-- Legal -->
            <div style="margin-top:2rem; border-top:1px solid var(--border); padding-top:1.5rem; font-size:0.6875rem; line-height:1.6; color:var(--muted-foreground); display:flex; flex-direction:column; gap:0.75rem;">
                <p>
                    <span style="font-weight:700; text-transform:uppercase; letter-spacing:0.05em;"><?= e(t('footer', 'legalTitle')) ?>:</span>
                    <?= e($lang === 'en' ? $GLOBALS['INDEPENDENCE_DISCLAIMER']['en'] : $GLOBALS['INDEPENDENCE_DISCLAIMER']['id']) ?>
                </p>
                <p><?= e($lang === 'en' ? $GLOBALS['PRICE_DISCLAIMER']['en'] : $GLOBALS['PRICE_DISCLAIMER']['id']) ?></p>
                <p><?= e(t('footer', 'visualNote')) ?></p>
            </div>

            <!-- Digital support credits -->
            <?php if (!empty($DESIGN_CREDIT) || !empty($MANAGEMENT_CREDIT)): ?>
            <div style="margin-top:2.5rem; border-top:1px solid var(--border); padding-top:2rem;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:1rem; text-align:center;">
                    <p style="font-size:0.6875rem; font-weight:700; text-transform:uppercase; letter-spacing:0.28em; color:rgba(156,168,163,0.8);"><?= e(t('footer', 'supportTitle')) ?></p>
                    <p style="font-size:0.75rem; color:var(--muted-foreground);"><?= e(t('footer', 'supportNote')) ?></p>
                    <div style="display:flex; flex-wrap:wrap; align-items:stretch; justify-content:center; gap:0.75rem;">
                        <?php if (!empty($DESIGN_CREDIT)): ?>
                        <a href="<?= e($DESIGN_CREDIT['url']) ?>" target="_blank" rel="noopener noreferrer" class="footer-credit">
                            <span aria-hidden="true" style="display:inline-flex; align-items:center; justify-content:center; width:2.5rem; height:2.5rem; border-radius:0.5rem; background:linear-gradient(135deg,#10b981,#14b8a6); color:#fff; font-family:var(--font-display); font-size:0.875rem; font-weight:900;">DG</span>
                            <span style="display:flex; flex-direction:column; text-align:left;">
                                <span style="font-size:0.625rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);"><?= e($DESIGN_CREDIT['label']) ?></span>
                                <span style="font-size:0.875rem; font-weight:600;"><?= e($DESIGN_CREDIT['orgName'] ?? $DESIGN_CREDIT['name'] ?? 'Design') ?></span>
                                <span style="font-size:0.6875rem; color:var(--muted-foreground);"><?= e($DESIGN_CREDIT['scope'] ?? '') ?> · <?= e(parse_url($DESIGN_CREDIT['url'], PHP_URL_HOST) ?: $DESIGN_CREDIT['domain'] ?? '') ?></span>
                            </span>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($MANAGEMENT_CREDIT)): ?>
                        <a href="<?= e($MANAGEMENT_CREDIT['url']) ?>" target="_blank" rel="noopener noreferrer" class="footer-credit">
                            <span aria-hidden="true" style="display:inline-flex; align-items:center; justify-content:center; width:2.5rem; height:2.5rem; border-radius:0.5rem; background:linear-gradient(135deg,#0d9488,#10b981); color:#fff; font-family:var(--font-display); font-size:0.875rem; font-weight:900;">TK</span>
                            <span style="display:flex; flex-direction:column; text-align:left;">
                                <span style="font-size:0.625rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--muted-foreground);"><?= e($MANAGEMENT_CREDIT['label']) ?></span>
                                <span style="font-size:0.875rem; font-weight:600;"><?= e($MANAGEMENT_CREDIT['orgName'] ?? $MANAGEMENT_CREDIT['name'] ?? 'Management') ?></span>
                                <span style="font-size:0.6875rem; color:var(--muted-foreground);"><?= e(parse_url($MANAGEMENT_CREDIT['url'], PHP_URL_HOST) ?: $MANAGEMENT_CREDIT['domain'] ?? '') ?></span>
                            </span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($TEAM_CREDIT)): ?>
                    <p style="max-width:42rem; font-size:0.75rem; line-height:1.6; color:var(--muted-foreground);">
                        <?= e(t('footer', 'teamLabel')) ?>:
                        <span style="font-weight:600; color:rgba(243,247,244,0.8);"><?= e($TEAM_CREDIT['line'] ?? '') ?></span>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Bottom bar -->
            <div style="margin-top:2rem; border-top:1px solid var(--border); padding-top:1.5rem; display:flex; flex-direction:column; align-items:center; justify-content:space-between; gap:0.75rem; font-size:0.75rem; color:var(--muted-foreground);" class="md:flex-row">
                <p>© <span data-year><?= date('Y') ?></span> <?= e(t('footer', 'rights')) ?></p>
                <p style="font-weight:500;"><?= e(t('footer', 'madeIn')) ?></p>
                <button type="button" data-scroll-top style="display:inline-flex; align-items:center; gap:0.375rem; border:1px solid var(--border); border-radius:9999px; padding:0.375rem 0.875rem; font-size:0.75rem; font-weight:500; transition:all 0.15s ease;">
                    <?= e(t('footer', 'backToTop')) ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Giant decorative wordmark -->
        <div aria-hidden="true" style="pointer-events:none; user-select:none; overflow:hidden;">
            <p class="footer-wordmark">PUSAT GEELY</p>
        </div>
    </footer>

    <!-- Floating WhatsApp FAB (desktop) -->
    <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="floating-cta-fab hide" data-floating-wa aria-label="<?= e(t('floating', 'open')) ?>">
        <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
    </a>

    <!-- Mobile sticky CTA bar -->
    <div class="mobile-cta-bar" data-mobile-cta>
        <div class="container">
            <a href="/#test-drive" class="btn btn-outline" style="height:3rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="color:var(--primary);"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
                <?= e(t('floating', 'testDrive')) ?>
            </a>
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="height:3rem;">
                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                <?= e(t('floating', 'wa')) ?>
            </a>
        </div>
    </div>

    <!-- Geely Bot (AI chat widget) -->
    <button type="button" class="bot-fab" data-bot-fab aria-label="Geely Bot — Asisten AI" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" y1="16" x2="8" y2="16"/><line x1="16" y1="16" x2="16" y2="16"/></svg>
        <span class="bot-fab-pulse" aria-hidden="true"></span>
    </button>

    <section class="bot-panel" data-bot-panel role="dialog" aria-label="Geely Bot">
        <header class="bot-header">
            <span class="bot-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/></svg>
                <span class="bot-status-dot" aria-hidden="true"></span>
            </span>
            <div class="bot-name">
                <p class="bot-name-title">Geely Bot</p>
                <p class="bot-name-status"><?= $lang === 'en' ? 'Online • instant replies 24/7' : 'Online • balas instan 24/7' ?></p>
            </div>
            <button type="button" class="bot-action-btn" data-bot-reset aria-label="<?= $lang === 'en' ? 'Restart conversation' : 'Mulai ulang percakapan' ?>" title="<?= $lang === 'en' ? 'Restart' : 'Mulai ulang' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
            </button>
            <button type="button" class="bot-action-btn" data-bot-close aria-label="<?= $lang === 'en' ? 'Close chat' : 'Tutup chat' ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </header>
        <div class="bot-messages" data-bot-messages></div>
        <footer class="bot-footer">
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="bot-wa-handoff" data-bot-wa style="display:none;">
                <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                <?= $lang === 'en' ? 'Continue to WhatsApp' : 'Lanjut ke WhatsApp Sena' ?>
            </a>
            <form class="bot-form" data-bot-form>
                <input type="text" class="bot-input" data-bot-input maxlength="500" autocomplete="off" placeholder="<?= $lang === 'en' ? 'Ask about Geely…' : 'Tanya soal Geely…' ?>" aria-label="Geely Bot message">
                <button type="submit" class="bot-submit" aria-label="<?= $lang === 'en' ? 'Send message' : 'Kirim pesan' ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </form>
            <p class="bot-disclaimer">
                <?= $lang === 'en'
                    ? 'Geely Bot uses this website\'s data — answers are indicative, confirm via WhatsApp.'
                    : 'Geely Bot memakai data website ini — jawaban indikatif, konfirmasi final via WhatsApp.' ?>
            </p>
        </footer>
    </section>

    <script src="/assets/js/main.js?v=<?= filemtime(__DIR__ . '/../assets/js/main.js') ?>" defer></script>
</body>
</html>
