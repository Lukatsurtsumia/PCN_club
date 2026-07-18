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
/* Cookie consent (GDPR): gates Google Maps + Elfsight reviews.         */
/* Nothing third-party loads until the visitor clicks Accept.           */
/* ------------------------------------------------------------------ */
Alpine.store('consent', {
    value: null, // 'accepted' | 'refused' | null (undecided)
    _loaded: false,
    KEY: 'pcn_cookie_consent',
    MAX_AGE: 180 * 24 * 60 * 60 * 1000, // re-ask after ~6 months

    init() {
        try {
            const raw = JSON.parse(localStorage.getItem(this.KEY) || 'null');
            if (raw && raw.at && Date.now() - raw.at < this.MAX_AGE) {
                this.value = raw.v;
            }
        } catch (e) { /* ignore */ }
        if (this.value === 'accepted') this.loadThirdParty();
    },

    decided() { return this.value !== null; },
    accepted() { return this.value === 'accepted'; },

    set(v) {
        this.value = v;
        try { localStorage.setItem(this.KEY, JSON.stringify({ v, at: Date.now() })); } catch (e) { /* ignore */ }
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
});

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
