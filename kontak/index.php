<?php
/** Kontak page */
require_once __DIR__ . '/../includes/page-shell.php';
$lang = current_lang();
$waLink = wa_link('Halo Pusat Geely, saya ingin bertanya.');

page_header([
    'active' => 'contact',
    'title' => t('kontak', 'title'),
    'description' => t('kontak', 'subtitle'),
    'canonical' => SITE_URL . '/kontak',
]);
?>
<main>
    <section class="hero bg-grid" style="padding-block:3rem 2rem;">
        <div class="container">
            <span class="hero-eyebrow"><?= e(t('kontak', 'eyebrow')); ?></span>
            <h1 class="font-display" style="margin-top:1rem; font-size:clamp(2rem,4vw,3rem); font-weight:800; letter-spacing:-0.025em;"><?= e(t('kontak', 'title')); ?></h1>
            <p style="margin-top:0.75rem; max-width:42rem; color:var(--muted-foreground);"><?= e(t('kontak', 'subtitle')); ?></p>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width:48rem;">
            <!-- Contact channels -->
            <div style="display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-3">
                <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="card card-hover" style="text-align:center; text-decoration:none;">
                    <span class="service-icon" style="margin-inline:auto;">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
                    </span>
                    <h3 class="service-title" style="margin-top:0.875rem;">WhatsApp</h3>
                    <p class="service-desc"><?= e(BUSINESS['wa_display']); ?></p>
                </a>
                <a href="mailto:<?= e(BUSINESS['email']); ?>" class="card card-hover" style="text-align:center; text-decoration:none;">
                    <span class="service-icon" style="margin-inline:auto;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>
                    </span>
                    <h3 class="service-title" style="margin-top:0.875rem;">Email</h3>
                    <p class="service-desc"><?= e(BUSINESS['email']); ?></p>
                </a>
                <a href="<?= e(BUSINESS['instagram_url']); ?>" target="_blank" rel="noopener noreferrer" class="card card-hover" style="text-align:center; text-decoration:none;">
                    <span class="service-icon" style="margin-inline:auto;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </span>
                    <h3 class="service-title" style="margin-top:0.875rem;">Instagram</h3>
                    <p class="service-desc"><?= e(BUSINESS['instagram']); ?></p>
                </a>
            </div>

            <!-- Quick message form -->
            <h2 class="font-display" style="margin-top:3rem; font-size:1.5rem; font-weight:700;"><?= e(t('kontak', 'formTitle')); ?></h2>
            <form class="form-card" data-lead-form style="margin-top:1rem;">
                <div data-form-message></div>
                <input type="hidden" name="csrf" value="<?= e(csrf_token()); ?>">
                <div style="display:grid; grid-template-columns:1fr; gap:1rem;" class="md:grid-cols-2">
                    <div>
                        <label class="label" for="k-name"><?= e(t('testDrive', 'name')); ?> *</label>
                        <input type="text" class="input" name="name" id="k-name" required>
                    </div>
                    <div>
                        <label class="label" for="k-phone"><?= e(t('testDrive', 'phone')); ?> *</label>
                        <input type="tel" class="input" name="phone" id="k-phone" required>
                    </div>
                </div>
                <div style="margin-top:1rem;">
                    <label class="label" for="k-message"><?= e(t('testDrive', 'message')); ?></label>
                    <textarea class="textarea" name="message" id="k-message" rows="5"></textarea>
                </div>
                <div style="margin-top:1.5rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-primary btn-lg"><?= e(t('testDrive', 'submitForm')); ?></button>
                    <a href="<?= e($waLink); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-lg"><?= e(t('testDrive', 'submit')); ?></a>
                </div>
            </form>
        </div>
    </section>
</main>
<?php page_footer(); ?>
