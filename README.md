# PCN - Pugilist Club Niçois

Official website for the **Pugilist Club Niçois**, a boxing club in Nice, France (established 1969).

**Live:** https://pcnboxe.com

Designed, built, and owned by **Luka Tsurtsumia**.

---

## Features

- French-first, bilingual site (FR / EN switcher)
- Animated **3D boxer** hero built with three.js
- Training programs, courses & pricing
- Live Google reviews
- Location with embedded map
- Private contact inbox + visitor counter (file-based, no database)

## Tech stack

- **Laravel 13** (PHP 8.4)
- Blade + **Vite** + **Tailwind CSS**
- **Alpine.js** for interactivity
- **three.js** for the 3D animation
- File-based storage (no database)
- Deployed with **Docker** on **Coolify**

## Running locally

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run build      # or: npm run dev
php artisan serve
```

---

## License & Ownership

**© 2026 Luka Tsurtsumia. All rights reserved.**

This repository is public **for review and portfolio-evaluation purposes only**.
It is **not** open source. The code, along with the PCN name, logo, and branding,
may **not** be copied, reused, modified, or deployed without the author's written
permission. See [LICENSE](LICENSE) for full terms.
