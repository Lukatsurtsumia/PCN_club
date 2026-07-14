# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project state

This is a freshly scaffolded Laravel 13 application (Laravel Breeze, Blade + Alpine.js stack) with no custom domain code yet beyond the default auth/profile scaffolding. `livewire/livewire` (^4.3) is a declared dependency but not yet used anywhere — expect Livewire components to be introduced as the app grows.

## Commands

Setup (first time):
```bash
composer install
cp .env.example .env   # if .env doesn't exist
php artisan key:generate
php artisan migrate
npm install
```

Development (runs PHP server, queue listener, Pail log viewer, and Vite concurrently):
```bash
composer run dev
```

Run the app pieces individually if needed:
```bash
php artisan serve
php artisan queue:listen --tries=1 --timeout=0
php artisan pail --timeout=0
npm run dev
```

Frontend build:
```bash
npm run build   # production build via Vite
npm run dev      # Vite dev server with HMR
```

Tests:
```bash
composer run test                  # clears config cache, then runs php artisan test
php artisan test                   # run full suite directly
php artisan test --filter=testName # run a single test by method/name
php artisan test tests/Feature/Auth/AuthenticationTest.php  # run a single file
```
Tests run against the `testing` DB connection with array session/cache/queue drivers and `sync` queue (see `phpunit.xml`), so no separate test DB setup is required beyond what's in `phpunit.xml`.

Code style:
```bash
vendor/bin/pint        # Laravel Pint (PSR-12 based formatter) — fix style
vendor/bin/pint --test # check only, no changes
```

Docker (Laravel Sail, optional — MySQL instead of default SQLite):
```bash
./vendor/bin/sail up
```
Note: `.env.example` defaults to `DB_CONNECTION=sqlite`; `compose.yaml` is set up for MySQL 8.4 if you switch to Sail.

## Architecture

- **Routing**: `routes/web.php` holds app routes (currently just `/`, `/dashboard`, and `/profile`); `routes/auth.php` (required from `web.php`) holds all Breeze-generated authentication routes (login, register, password reset, email verification, password confirmation). `routes/console.php` is for Artisan closure commands.
- **Bootstrapping**: `bootstrap/app.php` is the Laravel 13-style application bootstrap (no `Http/Kernel.php`) — middleware groups and exception handling are configured here via the fluent `Application::configure()` builder rather than in separate kernel classes.
- **Auth stack**: Standard Laravel Breeze (Blade) scaffolding — controllers under `app/Http/Controllers/Auth/`, form requests under `app/Http/Requests/Auth/`, views under `resources/views/auth/`. `App\Models\User` is the sole model currently.
- **Layouts/components**: Blade layout components in `app/View/Components/` (`AppLayout`, `GuestLayout`) pair with `resources/views/layouts/` and `resources/views/components/` for the shared UI shell (nav, dropdowns, form inputs, buttons, modal).
- **Frontend**: Vite + Tailwind CSS + Alpine.js (no SPA framework). Entry points are `resources/js/app.js` and `resources/css/app.css`, wired through `laravel-vite-plugin` in `vite.config.js`. Livewire is installed but not yet integrated into any view/route.
- **Database**: SQLite by default (`database/database.sqlite`). Migrations are the stock Laravel starter set (users, cache, jobs tables) — no domain-specific schema yet.
