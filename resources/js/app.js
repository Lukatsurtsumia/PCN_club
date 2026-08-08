import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('heroSlider', (slideCount = 3, intervalMs = 6000) => ({
    active: 0,
    total: slideCount,
    timer: null,
    touchX: null,
    touchY: null,

    init() {
        this.play();
    },

    play() {
        clearInterval(this.timer);
        this.timer = setInterval(() => this.next(), intervalMs);
    },

    stop() {
        clearInterval(this.timer);
    },

    next() {
        this.active = (this.active + 1) % this.total;
    },

    prev() {
        this.active = (this.active - 1 + this.total) % this.total;
    },

    goTo(index) {
        this.active = index;
        this.play();
    },

    // --- mobile swipe: left = next slide, right = previous ---
    touchStart(e) {
        const t = e.changedTouches[0];
        this.touchX = t.clientX;
        this.touchY = t.clientY;
    },

    touchEnd(e) {
        if (this.touchX === null) return;
        const t = e.changedTouches[0];
        const dx = t.clientX - this.touchX;
        const dy = t.clientY - this.touchY;
        this.touchX = this.touchY = null;
        // only a mostly-horizontal drag counts as a swipe, so vertical page
        // scrolling still works untouched
        if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
            dx < 0 ? this.next() : this.prev();
            this.play(); // restart the auto-advance timer after a manual swipe
        }
    },
}));

Alpine.data('navMenu', () => ({
    open: false,
    scrolled: false,

    init() {
        this.onScroll();
        window.addEventListener('scroll', () => this.onScroll(), { passive: true });
    },

    onScroll() {
        this.scrolled = window.scrollY > 40;
    },

    close() {
        this.open = false;
    },
}));

/* ------------------------------------------------------------------ */
/* Contact form: POSTs { name, email, phone, course, message } as JSON */
/* to the PCN Cloudflare Worker (config/pcn.php → contact_endpoint),    */
/* which relays it by email via Resend. Payload keys must match the    */
/* worker's expected fields exactly.                                   */
/* ------------------------------------------------------------------ */
Alpine.data('contactForm', (endpoint, errorText = '', turnstileError = '', turnstileEnabled = false) => ({
    endpoint,
    errorText,
    turnstileError,
    turnstileEnabled,
    sending: false,
    sent: false,
    error: '',
    turnstileToken: '',
    form: { name: '', email: '', phone: '', course: '', message: '' },

    init() {
        // Cloudflare Turnstile calls this global once the visitor passes the check
        window.onTurnstileCallback = (token) => { this.turnstileToken = token; };
    },

    async submit() {
        if (this.sending) return;

        // Only require a Turnstile token when the widget is actually enabled
        if (this.turnstileEnabled) {
            const field = document.querySelector('[name="cf-turnstile-response"]');
            this.turnstileToken = this.turnstileToken || (field ? field.value : '');
            if (! this.turnstileToken) {
                this.error = this.turnstileError;
                return;
            }
        }

        this.error = '';
        this.sending = true;

        try {
            const payload = {
                name: this.form.name,
                email: this.form.email,
                phone: this.form.phone,
                course: this.form.course,
                message: this.form.message,
            };
            if (this.turnstileEnabled) payload.turnstileToken = this.turnstileToken;

            const res = await fetch(this.endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload),
            });

            const data = await res.json().catch(() => ({}));

            if (res.ok && data.success) {
                this.sent = true;
                this.form = { name: '', email: '', phone: '', course: '', message: '' };
            } else {
                this.error = data.error || this.errorText;
                this.resetTurnstile();
            }
        } catch (e) {
            this.error = this.errorText;
            this.resetTurnstile();
        } finally {
            this.sending = false;
        }
    },

    // Turnstile tokens are single-use — clear + re-render the widget after a failed send
    resetTurnstile() {
        this.turnstileToken = '';
        if (this.turnstileEnabled && window.turnstile) window.turnstile.reset();
    },
}));

/* ------------------------------------------------------------------ */
/* Google reviews (Elfsight) with graceful fallback.                   */
/* The free plan caps monthly views; once hit, the widget renders      */
/* empty for visitors. We watch the container: if real reviews appear  */
/* we show them, otherwise we fall back to a static 5-star block.      */
/* ------------------------------------------------------------------ */
Alpine.data('reviewsWidget', () => ({
    state: 'loading', // 'loading' | 'widget' | 'fallback'

    init() {
        this.$store.consent.loadThirdParty(); // consent already granted at this point

        const selector = '.elfsight-app-0e0cdec6-2556-432d-a0b1-e2a0934c43a3';
        const started = Date.now();
        const MAX_WAIT = 12000; // give Elfsight time to load real reviews

        const check = () => {
            const el = document.querySelector(selector);
            // Elfsight fills the container with tall content when reviews load;
            // when the view cap is hit it stays empty (~0 height) for visitors.
            if (el && el.offsetHeight > 150) {
                this.state = 'widget';
                return;
            }
            if (Date.now() - started > MAX_WAIT) {
                if (this.state === 'loading') this.state = 'fallback';
                return;
            }
            setTimeout(check, 600);
        };
        setTimeout(check, 800);
    },
}));

/* ------------------------------------------------------------------ */
/* Cookie consent (GDPR): gates Google Maps + Elfsight reviews.         */
/* Nothing third-party loads until the visitor clicks Accept.           */
/* ------------------------------------------------------------------ */
Alpine.store('consent', (() => {
    const KEY = 'pcn_cookie_consent';
    const MAX_AGE = 180 * 24 * 60 * 60 * 1000; // re-ask after ~6 months

    // read the saved choice UP-FRONT (at definition time) so the banner never
    // re-appears on refresh, regardless of Alpine's init() timing
    let saved = null;
    try {
        const raw = JSON.parse(localStorage.getItem(KEY) || 'null');
        if (raw && raw.at && Date.now() - raw.at < MAX_AGE) saved = raw.v;
    } catch (e) { /* ignore */ }

    return {
        value: saved, // 'accepted' | 'refused' | null (undecided)
        _loaded: false,

        init() {
            if (this.value === 'accepted') this.loadThirdParty();
        },

        decided() { return this.value !== null; },
        accepted() { return this.value === 'accepted'; },

        set(v) {
            this.value = v;
            try { localStorage.setItem(KEY, JSON.stringify({ v, at: Date.now() })); } catch (e) { /* ignore */ }
            if (v === 'accepted') this.loadThirdParty();
        },

        reopen() { this.value = null; }, // "Cookie settings" — show the banner again

        // load the Elfsight reviews script only once the visitor has accepted
        loadThirdParty() {
            if (this._loaded) return;
            this._loaded = true;
            const s = document.createElement('script');
            s.src = 'https://elfsightcdn.com/platform.js';
            s.async = true;
            document.body.appendChild(s);
        },
    };
})());

Alpine.start();

/* ------------------------------------------------------------------ */
/* Scroll-reveal: fade/slide elements in as they enter the viewport.   */
/* ------------------------------------------------------------------ */
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.15, rootMargin: '0px 0px -60px 0px' }
);

document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));

/* ------------------------------------------------------------------ */
/* Animated stat counters.                                             */
/* ------------------------------------------------------------------ */
const animateCounter = (el) => {
    const target = parseFloat(el.dataset.counter);
    const suffix = el.dataset.counterSuffix || '';
    const duration = 1600;
    const start = performance.now();

    const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const value = Math.round(target * eased);
        el.textContent = value.toLocaleString() + suffix;
        if (progress < 1) requestAnimationFrame(step);
    };

    requestAnimationFrame(step);
};

const counterObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.5 }
);

document.querySelectorAll('[data-counter]').forEach((el) => counterObserver.observe(el));
