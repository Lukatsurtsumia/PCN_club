# PCN Boxe - Static Exporter & Cloudflare Pages Deployment

This directory contains the static site generator (`static_exporter`) for the PCN Boxing Club (Pugilist Club Niçois) website.

It compiles the Laravel Blade view templates (`resources/views/welcome.blade.php`) and frontend assets into standalone, static HTML/CSS/JS files (supporting both French and English versions) for deployment to **Cloudflare Pages** (`pcn-club-static`).

---

## 🏗️ How It Works

1. **Blade Template Parsing**: Reads `resources/views/welcome.blade.php`, `resources/views/schedule.blade.php`, and `resources/views/gallery.blade.php` and resolves Blade directives, layout extensions, loops (`@foreach`), and translations (`__('Key')`).
2. **Multi-language & Subpage Export**:
   - **French (Default)**:
     - Homepage: `dist/index.html`
     - Schedule: `dist/horaires/index.html` and `dist/horaires.html`
     - Gallery: `dist/galerie/index.html` and `dist/galerie.html`
   - **English**:
     - Homepage: `dist/en/index.html`
     - Schedule: `dist/en/horaires/index.html` and `dist/en/horaires.html`
     - Gallery: `dist/en/galerie/index.html` and `dist/en/galerie.html`
3. **Asset Bundling**: Copies assets from `public/` and builds optimized, hashed CSS and JavaScript bundles using **Vite** into `dist/assets/`.
4. **Cloudflare Pages Deployment**: Deploys the static output in `./dist` to the Cloudflare Pages project **`pcn-club-static`** (which serves `pugilistclubnicois.fr`).

---

## 🚀 How to Build & Deploy to Cloudflare Pages

Follow these steps whenever you make changes to templates (`resources/views/`), styles (`resources/css/`), scripts (`resources/js/`), or public assets (`public/`).

### One-Command Build & Deploy:
```bash
cd static_exporter
npm run deploy
```

---

### Step-by-Step Breakdown:

#### Step 1: Navigate to `static_exporter`
```bash
cd static_exporter
```

#### Step 2: Install dependencies (if needed)
```bash
npm install
```

#### Step 3: Build the static site
```bash
npm run build
```

#### Step 4: Deploy to Cloudflare Pages (`pcn-club-static`)
```bash
npx wrangler pages deploy dist --project-name=pcn-club-static
```

Once deployment completes, Wrangler will push your changes live to `pugilistclubnicois.fr`.

---

## 💡 Quick Update Checklist

- [ ] Edit source files (`resources/views/welcome.blade.php`, `resources/css/app.css`, etc.)
- [ ] Run `cd static_exporter && npm run deploy`
