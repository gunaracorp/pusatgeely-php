/* ════════════════════════════════════════════════════════════════
   PUSAT GEELY — vanilla JS for all interactive features.
   No React, no Node, no build step — runs directly in the browser.
   ════════════════════════════════════════════════════════════════ */
(function () {
    'use strict';

    // ── SVG icon set (lucide-like, inlined for offline use) ──────────
    const ICONS = {
        menu: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>',
        close: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
        chevronDown: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>',
        arrowRight: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
        arrowUp: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/></svg>',
        whatsapp: '<svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>',
        bot: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><path d="M12 7v4"/><line x1="8" y1="16" x2="8" y2="16"/><line x1="16" y1="16" x2="16" y2="16"/></svg>',
        send: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>',
        sparkles: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/></svg>',
        calendarCheck: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>',
        phone: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>',
        mail: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg>',
        instagram: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37Z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        facebook: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
        tiktok: '<svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43V8.45a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.12Z"/></svg>',
        twitter: '<svg class="icon" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        clock: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        user: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
        search: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
        tag: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"/><circle cx="7.5" cy="7.5" r="0.5" fill="currentColor"/></svg>',
        wallet: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/></svg>',
        calculator: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="8" y2="10"/><line x1="12" y1="10" x2="12" y2="10"/><line x1="16" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="8" y2="14"/><line x1="12" y1="14" x2="12" y2="14"/><line x1="16" y1="14" x2="16" y2="14"/><line x1="8" y1="18" x2="8" y2="18"/><line x1="12" y1="18" x2="12" y2="18"/><line x1="16" y1="18" x2="16" y2="18"/></svg>',
        info: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="8"/></svg>',
        bookOpen: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
        swords: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="14.5 17.5 3 6 3 3 6 3 17.5 14.5"/><line x1="13" y1="19" x2="19" y2="13"/><line x1="16" y1="16" x2="20" y2="20"/><line x1="19" y1="21" x2="21" y2="19"/></svg>',
        images: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="3" x2="18" y2="21"/><path d="M22 12H2"/><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/></svg>',
        bookMarked: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/><line x1="12" y1="3" x2="12" y2="16"/></svg>',
        moon: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>',
        sun: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>',
        questionCircle: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
        globe: '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
    };

    // ── Helper: send API request ─────────────────────────────────────
    async function api(url, options = {}) {
        const opts = {
            method: options.method || 'GET',
            headers: { 'Content-Type': 'application/json', ...(options.headers || {}) },
        };
        if (options.body) opts.body = JSON.stringify(options.body);
        const res = await fetch(url, opts);
        let data = null;
        try { data = await res.json(); } catch (_) {}
        return { ok: res.ok, status: res.status, data };
    }

    // ── Helper: render minimal markdown (**bold** + line breaks) ─────
    function renderRich(text) {
        const lines = String(text || '').split(/\n/);
        return lines.map(line => {
            const segs = line.split(/\*\*(.+?)\*\*/g);
            return '<span style="display:block">' + segs.map((s, i) =>
                i % 2 === 1 ? '<strong>' + escapeHtml(s) + '</strong>' : escapeHtml(s)
            ).join('') + '</span>';
        }).join('');
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, c =>
            ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c])
        );
    }

    // ── 1) Mobile nav drawer ─────────────────────────────────────────
    function initMobileNav() {
        const toggle = document.querySelector('[data-menu-toggle]');
        const drawer = document.querySelector('[data-drawer]');
        const backdrop = document.querySelector('[data-drawer-backdrop]');
        if (!toggle || !drawer || !backdrop) return;

        function open() {
            drawer.classList.add('open');
            backdrop.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function close() {
            drawer.classList.remove('open');
            backdrop.classList.remove('open');
            document.body.style.overflow = '';
        }
        toggle.addEventListener('click', open);
        backdrop.addEventListener('click', close);
        drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', close));
        document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
    }

    // ── 2) Language toggle ──────────────────────────────────────────
    function initLangToggle() {
        const toggles = document.querySelectorAll('[data-lang-toggle]');
        toggles.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-lang-target') || (document.documentElement.lang === 'id' ? 'en' : 'id');
                const sep = location.search.includes('?') ? '&' : '?';
                location.href = location.pathname + location.search + sep + 'lang=' + target + location.hash;
            });
        });
    }

    // ── 3) FAQ accordion ─────────────────────────────────────────────
    function initFaq() {
        document.querySelectorAll('[data-faq-item]').forEach(item => {
            const q = item.querySelector('[data-faq-question]');
            if (!q) return;
            q.addEventListener('click', () => {
                const isOpen = item.classList.contains('open');
                // Close all in same group
                const group = item.closest('[data-faq-group]');
                if (group) group.querySelectorAll('[data-faq-item]').forEach(i => i.classList.remove('open'));
                if (!isOpen) item.classList.add('open');
            });
        });
    }

    // ── 4) Floating CTA show/hide on scroll ─────────────────────────
    function initFloatingCta() {
        const wa = document.querySelector('[data-floating-wa]');
        const mobile = document.querySelector('[data-mobile-cta]');
        if (wa) {
            const onScroll = () => {
                if (window.scrollY > 480) {
                    wa.classList.add('show');
                    wa.classList.remove('hide');
                    if (mobile) mobile.classList.add('show');
                } else {
                    wa.classList.add('hide');
                    wa.classList.remove('show');
                    if (mobile) mobile.classList.remove('show');
                }
            };
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
        }
    }

    // ── 5) Scroll-to-top button ─────────────────────────────────────
    function initScrollTop() {
        const btn = document.querySelector('[data-scroll-top]');
        if (!btn) return;
        btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    }

    // ── 6) Reveal on scroll ─────────────────────────────────────────
    function initReveal() {
        const els = document.querySelectorAll('[data-reveal]');
        if (!els.length) return;
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('animate-in');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        els.forEach(el => io.observe(el));
    }

    // ── 7) Test drive form submission ───────────────────────────────
    function initLeadForm() {
        const form = document.querySelector('[data-lead-form]');
        if (!form) return;
        const msgEl = form.querySelector('[data-form-message]');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (msgEl) msgEl.innerHTML = '';

            const data = {
                name: form.querySelector('[name="name"]')?.value.trim() || '',
                phone: form.querySelector('[name="phone"]')?.value.trim() || '',
                model: form.querySelector('[name="model"]')?.value || '',
                interest: form.querySelector('[name="interest"]')?.value || 'general',
                area: form.querySelector('[name="area"]')?.value || '',
                preferredDate: form.querySelector('[name="preferred_date"]')?.value || '',
                message: form.querySelector('[name="message"]')?.value || '',
                lang: document.documentElement.lang || 'id',
                source: window.location.pathname,
                csrf: form.querySelector('[name="csrf"]')?.value || '',
            };

            if (!data.name || !data.phone) {
                if (msgEl) msgEl.innerHTML = '<div class="form-error">Nama dan nomor WhatsApp wajib diisi.</div>';
                return;
            }

            const submitBtn = form.querySelector('[type="submit"]');
            const originalText = submitBtn?.textContent;
            if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = 'Mengirim…'; }

            try {
                const r = await api('/api/leads.php', { method: 'POST', body: data });
                if (r.ok && r.data?.ok) {
                    if (msgEl) msgEl.innerHTML = '<div class="form-success">' + (r.data.message || 'Terima kasih! Permintaan Anda kami terima.') + '</div>';
                    form.reset();
                } else {
                    throw new Error(r.data?.error || 'server_error');
                }
            } catch (err) {
                if (msgEl) msgEl.innerHTML = '<div class="form-error">Maaf, terjadi gangguan. Silakan coba lagi atau hubungi kami via WhatsApp.</div>';
            } finally {
                if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = originalText; }
            }
        });
    }

    // ── 8) Review form ──────────────────────────────────────────────
    function initReviewForm() {
        const form = document.querySelector('[data-review-form]');
        if (!form) return;
        const msgEl = form.querySelector('[data-form-message]');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                modelId: form.querySelector('[name="model_id"]')?.value || '',
                name: form.querySelector('[name="name"]')?.value.trim() || '',
                city: form.querySelector('[name="city"]')?.value.trim() || '',
                rating: parseInt(form.querySelector('[name="rating"]')?.value || '5', 10),
                comment: form.querySelector('[name="comment"]')?.value.trim() || '',
                csrf: form.querySelector('[name="csrf"]')?.value || '',
            };
            if (!data.name || !data.comment) {
                if (msgEl) msgEl.innerHTML = '<div class="form-error">Nama dan komentar wajib diisi.</div>';
                return;
            }
            try {
                const r = await api('/api/reviews.php', { method: 'POST', body: data });
                if (r.ok && r.data?.ok) {
                    if (msgEl) msgEl.innerHTML = '<div class="form-success">Terima kasih! Ulasan Anda akan tampil setelah dimoderasi.</div>';
                    form.reset();
                } else throw new Error(r.data?.error || 'server_error');
            } catch (err) {
                if (msgEl) msgEl.innerHTML = '<div class="form-error">Gagal mengirim. Coba lagi nanti.</div>';
            }
        });
    }

    // ── 9) Financing simulator ──────────────────────────────────────
    function initFinancingSim() {
        const sim = document.querySelector('[data-financing-sim]');
        if (!sim) return;

        const priceInput = sim.querySelector('[name="price"]');
        const dpPctInput = sim.querySelector('[name="dp_pct"]');
        const tenorInput = sim.querySelector('[name="tenor"]');
        const resultEl = sim.querySelector('[data-sim-result]');
        const detailEls = {
            price: sim.querySelector('[data-sim-price]'),
            dp: sim.querySelector('[data-sim-dp]'),
            loan: sim.querySelector('[data-sim-loan]'),
            installment: sim.querySelector('[data-sim-installment]'),
            total: sim.querySelector('[data-sim-total]'),
        };

        function formatIDR(v) {
            return 'Rp ' + Math.round(v).toLocaleString('id-ID');
        }

        function calc() {
            const price = parseFloat(priceInput?.value) || 0;
            const dpPct = parseFloat(dpPctInput?.value) || 20;
            const tenor = parseInt(tenorInput?.value, 10) || 48;
            // Assumed annual interest rate (flat) — 6% typical for new car loan
            const rate = 0.06;
            const dp = price * (dpPct / 100);
            const loan = price - dp;
            const totalInterest = loan * rate * (tenor / 12);
            const totalLoan = loan + totalInterest;
            const installment = totalLoan / tenor;

            if (detailEls.price) detailEls.price.textContent = formatIDR(price);
            if (detailEls.dp) detailEls.dp.textContent = formatIDR(dp) + ' (' + dpPct + '%)';
            if (detailEls.loan) detailEls.loan.textContent = formatIDR(loan);
            if (detailEls.installment) detailEls.installment.textContent = formatIDR(installment);
            if (detailEls.total) detailEls.total.textContent = formatIDR(totalLoan);
            if (resultEl) resultEl.style.opacity = '1';
        }

        [priceInput, dpPctInput, tenorInput].forEach(el => el?.addEventListener('input', calc));
        calc();
    }

    // ── 10) Geely Bot (AI chat widget) ─────────────────────────────
    function initChatWidget() {
        const fab = document.querySelector('[data-bot-fab]');
        const panel = document.querySelector('[data-bot-panel]');
        if (!fab || !panel) return;

        const messagesEl = panel.querySelector('[data-bot-messages]');
        const form = panel.querySelector('[data-bot-form]');
        const input = panel.querySelector('[data-bot-input]');
        const closeBtn = panel.querySelector('[data-bot-close]');
        const resetBtn = panel.querySelector('[data-bot-reset]');
        const waHandoff = panel.querySelector('[data-bot-wa]');
        const lang = document.documentElement.lang || 'id';

        const GREETING = lang === 'en'
            ? 'Hi! I\'m Geely Bot, the AI assistant of Pusat Geely. Ask me anything about the EX5, EX2, Starray EM-i, Coolray, pricing, financing, or test drives — instant answers, 24/7.'
            : 'Halo! Saya Geely Bot, asisten AI Pusat Geely. Tanya apa saja soal EX5, EX2, Starray EM-i, Coolray, harga, kredit, atau test drive — saya bantu jawab instan.';

        const SUGGESTIONS = lang === 'en'
            ? ['How much is the Geely EX5?', 'Compare EX5 vs Coolray', 'How does financing work?', 'I want to book a test drive']
            : ['Berapa harga Geely EX5?', 'Bandingkan EX5 vs Coolray', 'Cara simulasi kreditnya?', 'Booking test drive dong'];

        const ERROR_MSG = lang === 'en'
            ? 'Oops, the bot connection hiccuped. Try again shortly or reach us on WhatsApp.'
            : 'Waduh, koneksi bot terganggu. Coba lagi sebentar atau langsung chat WhatsApp ya.';

        let opened = false;
        let messages = [];

        function renderMessages() {
            if (!messagesEl) return;
            messagesEl.innerHTML = messages.map(m => {
                if (m.role === 'user') {
                    return '<div class="bot-msg bot-msg-user"><div class="bot-msg-bubble">' + escapeHtml(m.content) + '</div></div>';
                }
                return '<div class="bot-msg bot-msg-assistant">' +
                    '<span class="bot-msg-avatar" aria-hidden="true">' + ICONS.bot + '</span>' +
                    '<div class="bot-msg-bubble">' + renderRich(m.content) + '</div>' +
                    '</div>';
            }).join('');
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }

        function renderSuggestions() {
            if (!messagesEl) return;
            if (messages.length > 1) return; // hide after first user message
            const existing = messagesEl.querySelector('[data-suggestions]');
            if (existing) existing.remove();
            const wrap = document.createElement('div');
            wrap.setAttribute('data-suggestions', '');
            wrap.className = 'bot-suggestions';
            wrap.innerHTML = SUGGESTIONS.map(s => '<button type="button" class="bot-suggestion">' + escapeHtml(s) + '</button>').join('');
            messagesEl.appendChild(wrap);
            wrap.querySelectorAll('.bot-suggestion').forEach((b, i) => {
                b.addEventListener('click', () => send(SUGGESTIONS[i]));
            });
        }

        function showTyping() {
            if (!messagesEl) return;
            const t = document.createElement('div');
            t.setAttribute('data-typing', '');
            t.className = 'bot-msg bot-msg-assistant';
            t.innerHTML = '<span class="bot-msg-avatar" aria-hidden="true">' + ICONS.bot + '</span>' +
                '<span class="bot-typing"><span class="bot-typing-dot"></span><span class="bot-typing-dot"></span><span class="bot-typing-dot"></span></span>';
            messagesEl.appendChild(t);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }
        function hideTyping() {
            messagesEl?.querySelector('[data-typing]')?.remove();
        }

        async function send(text) {
            const content = (text || '').trim();
            if (!content) return;
            messages.push({ role: 'user', content });
            renderMessages();
            renderSuggestions();
            if (input) input.value = '';

            showTyping();
            try {
                const r = await api('/api/chat.php', {
                    method: 'POST',
                    body: { messages: messages.slice(-12), lang }
                });
                hideTyping();
                if (r.ok && r.data?.ok && r.data.reply) {
                    messages.push({ role: 'assistant', content: r.data.reply });
                    renderMessages();
                    if (r.data.waUrl && waHandoff) {
                        waHandoff.style.display = 'flex';
                        waHandoff.href = r.data.waUrl;
                    }
                } else {
                    messages.push({ role: 'assistant', content: ERROR_MSG });
                    renderMessages();
                }
            } catch (err) {
                hideTyping();
                messages.push({ role: 'assistant', content: ERROR_MSG });
                renderMessages();
            }
        }

        function reset() {
            messages = [{ role: 'assistant', content: GREETING }];
            renderMessages();
            renderSuggestions();
            if (waHandoff) waHandoff.style.display = 'none';
        }

        function toggle() {
            const isOpen = panel.classList.toggle('open');
            if (isOpen && !opened) {
                opened = true;
                reset();
            }
            fab.innerHTML = isOpen ? ICONS.close : ICONS.bot;
            if (!isOpen) fab.innerHTML = ICONS.bot;
            // Add pulse back when closed
            if (!isOpen) {
                fab.innerHTML = ICONS.bot + '<span class="bot-fab-pulse" aria-hidden="true"></span>';
            }
        }

        fab.addEventListener('click', toggle);
        closeBtn?.addEventListener('click', toggle);
        resetBtn?.addEventListener('click', reset);

        form?.addEventListener('submit', (e) => {
            e.preventDefault();
            send(input?.value);
        });
    }

    // ── 11) Keyword explorer (filter) ───────────────────────────────
    function initKeywordFilter() {
        const input = document.querySelector('[data-keyword-search]');
        const list = document.querySelector('[data-keyword-list]');
        if (!input || !list) return;
        const items = Array.from(list.querySelectorAll('[data-keyword]'));
        const countEl = document.querySelector('[data-keyword-count]');
        const noResult = document.querySelector('[data-keyword-no-result]');

        input.addEventListener('input', () => {
            const q = input.value.toLowerCase().trim();
            let shown = 0;
            items.forEach(item => {
                const text = (item.getAttribute('data-keyword') || '').toLowerCase();
                if (!q || text.includes(q)) {
                    item.style.display = '';
                    shown++;
                } else {
                    item.style.display = 'none';
                }
            });
            if (countEl) countEl.textContent = shown;
            if (noResult) noResult.style.display = shown === 0 ? 'block' : 'none';
        });
    }

    // ── 12) Theme toggle (dark/light) ───────────────────────────────
    function initThemeToggle() {
        const stored = localStorage.getItem('pg_theme') || 'dark';
        document.documentElement.setAttribute('data-theme', stored);
        document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                const cur = document.documentElement.getAttribute('data-theme') || 'dark';
                const next = cur === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('pg_theme', next);
            });
        });
    }

    // ── 13) Scroll progress indicator ───────────────────────────────
    function initScrollProgress() {
        const bar = document.querySelector('[data-scroll-progress]');
        if (!bar) return;
        const onScroll = () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            bar.style.width = pct + '%';
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // ── 14) Lazy-load images (for old browsers) ────────────────────
    function initLazyImages() {
        // Native lazy loading via loading="lazy" attribute handles most cases.
        // This is a fallback for browsers that don't support it.
        if ('loading' in HTMLImageElement.prototype) return;
        const imgs = document.querySelectorAll('img[loading="lazy"]');
        if (!imgs.length) return;
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const img = e.target;
                    if (img.dataset.src) img.src = img.dataset.src;
                    io.unobserve(img);
                }
            });
        });
        imgs.forEach(img => io.observe(img));
    }

    // ── 15) Gallery lightbox (simple) ──────────────────────────────
    function initLightbox() {
        const triggers = document.querySelectorAll('[data-lightbox-trigger]');
        if (!triggers.length) return;
        const overlay = document.createElement('div');
        overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:100;display:none;align-items:center;justify-content:center;padding:1rem;cursor:pointer;';
        overlay.innerHTML = '<img alt="" style="max-width:100%;max-height:100%;border-radius:0.5rem;">';
        document.body.appendChild(overlay);
        const img = overlay.querySelector('img');
        triggers.forEach(t => {
            t.addEventListener('click', (e) => {
                e.preventDefault();
                const src = t.getAttribute('href') || t.querySelector('img')?.src;
                if (src) {
                    img.src = src;
                    img.alt = t.getAttribute('aria-label') || '';
                    overlay.style.display = 'flex';
                }
            });
        });
        overlay.addEventListener('click', () => overlay.style.display = 'none');
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') overlay.style.display = 'none'; });
    }

    // ── 16) Year stamp in footer ───────────────────────────────────
    function initYear() {
        document.querySelectorAll('[data-year]').forEach(el => {
            el.textContent = String(new Date().getFullYear());
        });
    }

    // ── 17) GA4 (optional, loaded from window) ────────────────────
    function initAnalytics() {
        const gaId = document.documentElement.getAttribute('data-ga-id');
        if (!gaId) return;
        const s1 = document.createElement('script');
        s1.async = true;
        s1.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(gaId);
        document.head.appendChild(s1);
        window.dataLayer = window.dataLayer || [];
        function gtag() { window.dataLayer.push(arguments); }
        window.gtag = gtag;
        gtag('js', new Date());
        gtag('config', gaId, { anonymize_ip: true });
    }

    // ── Init all on DOMContentLoaded ──────────────────────────────
    function init() {
        initThemeToggle();
        initMobileNav();
        initLangToggle();
        initFaq();
        initFloatingCta();
        initScrollTop();
        initReveal();
        initLeadForm();
        initReviewForm();
        initFinancingSim();
        initChatWidget();
        initKeywordFilter();
        initScrollProgress();
        initLazyImages();
        initLightbox();
        initYear();
        initAnalytics();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Export for inline scripts that need to call helpers
    window.PG = { api, renderRich, escapeHtml, ICONS };
})();
