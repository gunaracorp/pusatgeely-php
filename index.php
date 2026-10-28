<?php
/**
 * Homepage — Pusat Geely
 */

require_once __DIR__ . '/includes/page-shell.php';

$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya ingin bertanya tentang mobil Geely.');

page_header([
    'active' => 'home',
    'title' => 'Pusat Geely — Mobil Geely Bogor & Jabodetabek | Test Drive, Harga & Simulasi Kredit',
    'description' => 'Konsultan penjualan Geely untuk Bogor & Jabodetabek. Panduan memilih Geely EX5, EX2, Starray EM-i, dan Coolray — test drive fleksibel, penawaran harga transparan, simulasi kredit, dan trade-in via WhatsApp.',
    'canonical' => SITE_URL,
    'ogImage' => SITE_URL . '/assets/images/hero.webp',
    'defaultSchema' => true,
]);
?>

<main>
    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="hero bg-grid" id="beranda">
        <div class="container">
            <span class="hero-eyebrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                <?= e(t('hero', 'eyebrow')) ?>
            </span>
            <h1><?= e(t('hero', 'title')) ?></h1>
            <p class="hero-subtitle"><?= e(t('hero', 'subtitle')) ?></p>
            <div class="hero-cta">
                <a href="#test-drive" class="btn btn-primary btn-lg">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <?= e(t('hero', 'ctaPrimary')) ?>
                </a>
                <a href="#model" class="btn btn-outline btn-lg">
                    <?= e(t('hero', 'ctaSecondary')) ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                    Chat WhatsApp
                </a>
            </div>

            <!-- Quick stats -->
            <div style="margin-top:3rem; display:grid; grid-template-columns:repeat(2,1fr); gap:1rem;" class="md:grid-cols-4">
                <div class="card" style="text-align:center;">
                    <div class="font-display text-3xl font-bold" style="color:var(--primary);">4</div>
                    <div class="text-sm" style="color:var(--muted-foreground);">Model Geely</div>
                </div>
                <div class="card" style="text-align:center;">
                    <div class="font-display text-3xl font-bold" style="color:var(--primary);">10+</div>
                    <div class="text-sm" style="color:var(--muted-foreground);">Area Layanan</div>
                </div>
                <div class="card" style="text-align:center;">
                    <div class="font-display text-3xl font-bold" style="color:var(--primary);">5</div>
                    <div class="text-sm" style="color:var(--muted-foreground);">Pembiayaan</div>
                </div>
                <div class="card" style="text-align:center;">
                    <div class="font-display text-3xl font-bold" style="color:var(--primary);">24/7</div>
                    <div class="text-sm" style="color:var(--muted-foreground);">AI Bot</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         MODEL SECTION
         ════════════════════════════════════════════════════════════ -->
    <section class="section" id="model">
        <div class="container">
            <?php render_section_header(
                t('models', 'eyebrow'),
                t('models', 'title'),
                t('models', 'subtitle')
            ); ?>

            <div class="model-grid" style="margin-top:2.5rem;">
                <?php foreach ($MODELS as $model): ?>
                    <?php render_model_card($model); ?>
                <?php endforeach; ?>
            </div>

            <p style="margin-top:2rem; font-size:0.75rem; color:var(--muted-foreground); text-align:center;">
                <?= e($lang === 'en' ? $PRICE_DISCLAIMER['en'] : $PRICE_DISCLAIMER['id']) ?>
            </p>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         SERVICES
         ════════════════════════════════════════════════════════════ -->
    <section class="section bg-secondary" id="layanan">
        <div class="container">
            <?php render_section_header(
                t('services', 'eyebrow'),
                t('services', 'title'),
                t('services', 'subtitle')
            ); ?>

            <div class="service-grid" style="margin-top:2.5rem;">
                <?php
                $services = t_arr('services', 'items');
                $icons = [
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="8" y2="10"/><line x1="12" y1="10" x2="12" y2="10"/><line x1="16" y1="10" x2="16" y2="10"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',
                    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M9 11H5a2 2 0 0 0-2 2v7h18v-7a2 2 0 0 0-2-2h-4"/><path d="M15 9V5a3 3 0 0 0-6 0v4"/></svg>',
                ];
                $i = 0;
                foreach ($services as $key => $svc):
                    if (is_string($key)) {
                        $title = $svc[0] ?? '';
                        $desc = $svc[1] ?? '';
                    } else {
                        $title = $svc['booking'][0] ?? $svc['after'][0] ?? '';
                        $desc = $svc['booking'][1] ?? $svc['after'][1] ?? '';
                    }
                    render_service_card($icons[$i % count($icons)], $title, $desc);
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         PROMO & FINANCING
         ════════════════════════════════════════════════════════════ -->
    <section class="section" id="promo">
        <div class="container">
            <?php render_section_header(
                t('promo', 'eyebrow'),
                t('promo', 'title'),
                t('promo', 'subtitle')
            ); ?>

            <div style="margin-top:2.5rem; display:grid; grid-template-columns:1fr; gap:1.5rem;" class="lg:grid-cols-2">
                <?php foreach ($PROMO_PROGRAMS as $promo): ?>
                <div class="card card-hover" style="border-color:<?= e($promo['accent']); ?>40;">
                    <div style="display:flex; align-items:baseline; justify-content:space-between; gap:0.75rem;">
                        <h3 class="font-display text-lg font-bold"><?= e($promo['finance']); ?></h3>
                        <span class="badge badge-outline" style="border-color:<?= e($promo['accent']); ?>; color:<?= e($promo['accent']); ?>;">
                            <?= e($promo['badge'][$lang] ?? $promo['badge']['id']); ?>
                        </span>
                    </div>
                    <p style="margin-top:0.5rem; font-size:0.875rem; color:var(--muted-foreground);"><?= e($promo['program'][$lang] ?? $promo['program']['id']); ?></p>
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
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         FINANCING SIMULATOR
         ════════════════════════════════════════════════════════════ -->
    <section class="section bg-secondary" id="financing">
        <div class="container">
            <?php render_section_header(
                t('nav', 'simulator'),
                $lang === 'en' ? 'Estimate your monthly installment' : 'Hitung estimasi angsuran bulanan Anda',
                $lang === 'en' ? 'Quick estimate. Final installment depends on the financing company\'s policy and your credit profile.' : 'Estimasi cepat. Angsuran final tergantung kebijakan perusahaan pembiayaan dan profil kredit Anda.'
            ); ?>

            <div class="card" data-financing-sim style="margin-top:2.5rem; max-width:42rem; margin-inline:auto;">
                <div style="display:grid; grid-template-columns:1fr; gap:1.25rem;" class="md:grid-cols-3">
                    <div>
                        <label class="label" for="sim-price">Harga Mobil (Rp)</label>
                        <input type="number" class="input" name="price" id="sim-price" value="465000000" min="100000000" step="1000000">
                    </div>
                    <div>
                        <label class="label" for="sim-dp">DP (%)</label>
                        <input type="range" class="input" name="dp_pct" id="sim-dp" value="20" min="10" max="50" step="5" style="padding:0; height:auto;">
                        <div style="margin-top:0.25rem; font-size:0.75rem; color:var(--muted-foreground);"><span data-sim-dp-pct>20</span>%</div>
                    </div>
                    <div>
                        <label class="label" for="sim-tenor">Tenor (bulan)</label>
                        <select class="select" name="tenor" id="sim-tenor">
                            <option value="24">24</option>
                            <option value="36">36</option>
                            <option value="48" selected>48</option>
                            <option value="60">60</option>
                            <option value="72">72</option>
                        </select>
                    </div>
                </div>

                <div data-sim-result style="margin-top:1.5rem; padding:1.25rem; background:var(--muted); border-radius:var(--radius-md); transition:opacity 0.2s ease;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; font-size:0.875rem;">
                        <div>
                            <div style="color:var(--muted-foreground);">Harga Mobil</div>
                            <div class="font-bold" data-sim-price>Rp 0</div>
                        </div>
                        <div>
                            <div style="color:var(--muted-foreground);">Uang Muka (DP)</div>
                            <div class="font-bold" data-sim-dp>Rp 0</div>
                        </div>
                        <div>
                            <div style="color:var(--muted-foreground);">Pokok Pinjaman</div>
                            <div class="font-bold" data-sim-loan>Rp 0</div>
                        </div>
                        <div>
                            <div style="color:var(--muted-foreground);">Total Pinjaman + Bunga</div>
                            <div class="font-bold" data-sim-total>Rp 0</div>
                        </div>
                    </div>
                    <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid var(--border); text-align:center;">
                        <div style="font-size:0.75rem; color:var(--muted-foreground); text-transform:uppercase; letter-spacing:0.1em;">Estimasi Angsuran / Bulan</div>
                        <div class="font-display" style="font-size:2rem; font-weight:800; color:var(--primary); margin-top:0.25rem;" data-sim-installment>Rp 0</div>
                    </div>
                </div>

                <p style="margin-top:1rem; font-size:0.75rem; color:var(--muted-foreground);">
                    *Estimasi dengan asumsi bunga flat 6% per tahun. Angsuran aktual dapat berbeda — konfirmasi via WhatsApp untuk simulasi resmi dari 5 perusahaan pembiayaan.
                </p>

                <div style="margin-top:1.25rem; display:flex; gap:0.5rem; flex-wrap:wrap;">
                    <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        Konsultasi Kredit
                    </a>
                    <a href="/promo-geely-bogor" class="btn btn-outline">Lihat Promo Lengkap</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         GALLERY
         ════════════════════════════════════════════════════════════ -->
    <section class="section" id="galeri">
        <div class="container">
            <?php render_section_header(
                t('nav', 'gallery'),
                $lang === 'en' ? 'Real unit photos & handover moments' : 'Foto unit asli & momen serah terima',
                $lang === 'en' ? 'Documentary shots from actual deliveries — not stock photos.' : 'Foto dokumentasi dari penyerahan unit nyata — bukan stok foto.'
            ); ?>

            <div class="gallery-grid" style="margin-top:2.5rem;">
                <?php foreach (array_slice($GALLERY_UNITS, 0, 8) as $item): ?>
                <a href="<?= e($item['src']); ?>" class="gallery-item" data-lightbox-trigger aria-label="<?= e($item['caption'][$lang]); ?>">
                    <img src="<?= e($item['src']); ?>" alt="<?= e($item['alt'][$lang]); ?>" loading="lazy">
                    <span class="gallery-caption"><?= e($item['caption'][$lang]); ?></span>
                </a>
                <?php endforeach; ?>
            </div>

            <div style="margin-top:2.5rem; text-align:center;">
                <a href="#test-drive" class="btn btn-outline btn-lg"><?= $lang === 'en' ? 'See it in person — book test drive' : 'Lihat langsung — booking test drive' ?></a>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         TEST DRIVE FORM
         ════════════════════════════════════════════════════════════ -->
    <section class="section bg-secondary" id="test-drive">
        <div class="container">
            <?php render_section_header(
                t('testDrive', 'eyebrow'),
                t('testDrive', 'title'),
                t('testDrive', 'subtitle')
            ); ?>

            <form class="form-card" data-lead-form style="margin-top:2.5rem; max-width:42rem; margin-inline:auto;">
                <div data-form-message></div>
                <input type="hidden" name="csrf" value="<?= e(csrf_token()); ?>">

                <div style="display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-2">
                    <div>
                        <label class="label" for="td-name"><?= e(t('testDrive', 'name')) ?> *</label>
                        <input type="text" class="input" name="name" id="td-name" required autocomplete="name">
                    </div>
                    <div>
                        <label class="label" for="td-phone"><?= e(t('testDrive', 'phone')) ?> *</label>
                        <input type="tel" class="input" name="phone" id="td-phone" required autocomplete="tel" placeholder="08xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="label" for="td-model"><?= e(t('testDrive', 'model')) ?></label>
                        <select class="select" name="model" id="td-model">
                            <option value=""><?= $lang === 'en' ? '— Select model —' : '— Pilih model —' ?></option>
                            <?php foreach ($MODELS as $m): ?>
                            <option value="<?= e($m['id']); ?>"><?= e($m['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="label" for="td-interest"><?= e(t('testDrive', 'interest')) ?></label>
                        <select class="select" name="interest" id="td-interest">
                            <?php foreach (t_arr('testDrive', 'interests') as $key => $label): ?>
                            <option value="<?= e($key); ?>"><?= e($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="label" for="td-area"><?= e(t('testDrive', 'area')) ?></label>
                        <select class="select" name="area" id="td-area">
                            <option value=""><?= $lang === 'en' ? '— Select area —' : '— Pilih area —' ?></option>
                            <?php foreach ($AREAS as $area): ?>
                            <option value="<?= e($area); ?>"><?= e($area); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="label" for="td-date"><?= e(t('testDrive', 'date')) ?></label>
                        <input type="date" class="input" name="preferred_date" id="td-date">
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <label class="label" for="td-message"><?= e(t('testDrive', 'message')) ?></label>
                    <textarea class="textarea" name="message" id="td-message" rows="4" placeholder="<?= $lang === 'en' ? 'Tell us your preferences, questions, or anything we should know.' : 'Ceritakan preferensi Anda, pertanyaan, atau hal lain yang perlu kami tahu.' ?>"></textarea>
                </div>

                <div style="margin-top:1.5rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        <?= e(t('testDrive', 'submitForm')) ?>
                    </button>
                    <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        <?= e(t('testDrive', 'submit')) ?>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         COVERAGE
         ════════════════════════════════════════════════════════════ -->
    <section class="section" id="wilayah">
        <div class="container">
            <?php render_section_header(
                t('coverage', 'eyebrow'),
                t('coverage', 'title'),
                t('coverage', 'subtitle')
            ); ?>

            <ul class="area-chips" style="margin-top:2.5rem; max-width:48rem; margin-inline:auto; justify-content:center;">
                <?php foreach (t_arr('coverage', 'areas') as $area): ?>
                <li class="area-chip"><?= e($area); ?></li>
                <?php endforeach; ?>
            </ul>

            <div style="margin-top:2rem; text-align:center;">
                <p style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; border:1px solid var(--border); border-radius:9999px; background:var(--card); font-size:0.875rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16" style="color:var(--primary);"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <?= e(t('coverage', 'hoursLabel')); ?>: <strong style="margin-left:0.375rem;"><?= e($lang === 'en' ? BUSINESS['hours_en'] : BUSINESS['hours_id']); ?></strong>
                </p>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         FAQ
         ════════════════════════════════════════════════════════════ -->
    <section class="section bg-secondary" id="faq" data-faq-group>
        <div class="container">
            <?php render_section_header(
                t('faq', 'eyebrow'),
                t('faq', 'title'),
                t('faq', 'subtitle')
            ); ?>

            <div style="margin-top:2.5rem; max-width:48rem; margin-inline:auto;">
                <?php foreach (t_arr('faq', 'items') as $i => $faq): ?>
                <div class="faq-item" data-faq-item>
                    <button type="button" class="faq-question" data-faq-question>
                        <?= e($faq[0]); ?>
                        <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-answer">
                        <p><?= e($faq[1]); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         CTA BAND
         ════════════════════════════════════════════════════════════ -->
    <section class="section">
        <div class="container">
            <div style="overflow:hidden; border:1px solid rgba(26,163,126,0.3); border-radius:var(--radius-xl); background:linear-gradient(135deg, rgba(26,163,126,0.10), var(--card)); padding:2rem; text-align:center;">
                <h2 class="font-display" style="font-size:1.875rem; font-weight:800; letter-spacing:-0.025em;"><?= e(t('cta', 'title')); ?></h2>
                <p style="max-width:36rem; margin:0.75rem auto 0; color:var(--muted-foreground);"><?= e(t('cta', 'subtitle')); ?></p>
                <div style="margin-top:1.5rem; display:flex; gap:0.75rem; justify-content:center; flex-wrap:wrap;">
                    <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                        <?= e(t('cta', 'button')); ?>
                    </a>
                    <a href="#test-drive" class="btn btn-outline btn-lg"><?= e(t('hero', 'ctaPrimary')); ?></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php page_footer(); ?>
