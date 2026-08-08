import fs from 'fs-extra';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { build as viteBuild } from 'vite';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const ROOT_DIR = path.resolve(__dirname, '..');
const DIST_DIR = path.resolve(__dirname, 'dist');

// French translations (default app locale is FR)
const langFrPath = path.resolve(ROOT_DIR, 'lang/fr.json');
let dictFRFromFile = {};
try {
  if (fs.existsSync(langFrPath)) {
    dictFRFromFile = fs.readJsonSync(langFrPath);
  }
} catch (e) {
  console.warn('Could not read lang/fr.json:', e);
}

const dictFR = {
  ...dictFRFromFile,
  'About': 'À propos',
  'Programs': 'Programmes',
  'Fighters Say': 'Avis',
  'Location': 'Accès & Contact',
  'Join The Fight': 'Rejoindre le club',
  'PCN BOXING CLUB': 'PUGILIST CLUB NIÇOIS',
  'TRAIN LIKE A': 'S\'ENTRAÎNER COMME UN',
  'CHAMPION': 'CHAMPION',
  'Elite coaching, real ring craft, and a corner that pushes you every single round. This is where fighters are made.': 'Coaching d\'élite, vraie technique de ring et un coin qui vous pousse à chaque round. C\'est ici que l\'on forme les boxeurs.',
  'Join The Club': 'S\'inscrire au club',
  'View Programs': 'Voir les programmes',
  'EVERY ROUND COUNTS': 'CHAQUE ROUND COMPTE',
  'DISCIPLINE.': 'DISCIPLINE.',
  'POWER.': 'PUISSANCE.',
  'PRECISION.': 'PRÉCISION.',
  'From your first jab to your first fight night, our coaches build technique that lasts - not just a good workout.': 'Du tout premier jab jusqu\'aux soirées de gala, nos entraîneurs transmettent une technique durable.',
  'Our Story': 'Notre Histoire',
  'ONE TEAM. ONE CORNER.': 'UNE ÉQUIPE. UN COIN.',
  'JOIN THE': 'REJOIGNEZ LA',
  'PCN': 'FAMILLE',
  'FAMILY': 'PCN',
  'A gym built on respect, sweat, and community. All levels welcome - no experience needed to start.': 'Un club fondé sur le respect, le dépassement et l\'esprit d\'équipe. Tous niveaux bienvenus.',
  'Find The Gym': 'Trouver la salle',
  'ABOUT THE CLUB': 'À PROPOS DU CLUB',
  'MORE THAN A GYM.': 'PLUS QU\'UNE SALLE.',
  "IT'S A CORNER FOR LIFE.": 'UN COIN POUR LA VIE.',
  "PCN Boxing Club was founded on one idea: real technique, honest coaching, and a community that has your back between rounds. Whether you're stepping into a gym for the first time or chasing a title, our coaches meet you where you are and push you past it.": "Fondé en 1969, le Pugilist Club Niçois repose sur une vraie culture de la boxe anglaise, un suivi personnalisé et une ambiance solidaire.",
  'Certified professional coaches': 'Entraîneurs diplômés d\'État',
  'Beginner to competitive levels': 'Du débutant à la compétition',
  'Fully equipped modern ring': 'Ring homologué & équipement complet',
  'Structured fight-team pathway': 'Filière compétition structurée',
  'Years': 'Ans d\'expérience',
  'Members Trained': 'Membres formés',
  'Classes / Month': 'Cours / mois',
  'TRAINING PROGRAMS': 'NOS PROGRAMMES',
  'FIND YOUR ROUND': 'TROUVEZ VOTRE PRATIQUE',
  'Four paths. One gym. Every session is coached, structured, and built around real boxing fundamentals.': 'Quatre sections, un seul esprit. Chaque séance est encadrée et axée sur les fondamentaux.',
  'Youth Boxing': 'Boxe Éducative (8-16 ans)',
  'Ages 8-16': '8-16 ans',
  'Ages 8-16 build footwork, discipline and confidence with age-matched coaching.': 'Développement de la motricité, de la discipline et de la confiance en soi.',
  'Fitness Boxing': 'Boxe Fitness / Loisir',
  'All Levels': 'Tous niveaux',
  'High-energy pad and bag rounds that torch calories and sharpen technique.': 'Séances toniques aux sacs et aux paos pour brûler des calories et se défouler.',
  'Competitive Team': 'Section Compétition',
  'By Trial': 'Sur sélection',
  'Sparring, conditioning and fight-camp prep for our amateur roster.': 'Sparring, préparation physique et suivi personnalisé pour la compétition.',
  '1-on-1 Coaching': 'Coaching Privé',
  'Private': 'Sur mesure',
  'Private sessions dialed into your goals - form, power, or fight prep.': 'Séances individuelles adaptées à vos objectifs personnels.',
  'Learn more': 'En savoir plus',
  'REAL PEOPLE. REAL RESULTS.': 'L\'AVIS DE NOS MEMBRES',
  'VISIT THE CLUB': 'LE CLUB',
  'FIND YOUR WAY TO THE RING': 'VENEZ NOUS VOIR',
  'Address': 'Adresse',
  'Phone': 'Téléphone',
  'Hours': 'Horaires',
  'Get Directions': 'Itinéraire Google Maps',
  'COURSES & PRICING': 'TARIFS & INSCRIPTION',
  'Pick your discipline. Annual membership, coached by our team - license & insurance included.': 'Cotisation annuelle comprenant les cours encadrés, la licence et l\'assurance.',
  'Boxing · Adults': 'Boxe Anglaise · Adultes',
  'All levels · technique &amp; sparring': 'Tous niveaux · technique &amp; gants',
  'Youth School (8-16)': 'École de Boxe (8-16 ans)',
  'Dedicated junior coaching': 'Encadrement jeunes adapté',
  'Fit Boxing': 'Fit Boxing / Cardio',
  'Cardio · conditioning · pads': 'Cardio · renforcement · sacs',
  'year': 'an',
  'Indicative pricing - contact us for full details and required certificates.': 'Tarifs indicatifs - nous contacter pour la liste des documents requis.',
  'SEND US A MESSAGE': 'ENVOYER UN MESSAGE',
  'A question or want to sign up? Drop us a line.': 'Une question ou envie de vous inscrire ? Écrivez-nous.',
  'Name': 'Nom & Prénom',
  'Your name': 'Votre nom',
  'Email': 'Email',
  'Course of interest': 'Discipline souhaitée',
  'Choose': 'Choisir',
  'Other': 'Autre',
  'Message': 'Message',
  "Tell us what you're looking for…": 'Votre message…',
  'Send Message': 'Envoyer',
  'A boxing club built on discipline, respect and real coaching - from your first jab to your first fight.': 'Un club d\'histoire axé sur le respect, la discipline et la vraie boxe anglaise à Nice.',
  'Quick Links': 'Liens rapides',
  'Stay Sharp': 'Restez informé',
  'Get schedule updates and fight-night announcements.': 'Recevez les actualités et événements du club.',
  'Your email': 'Votre email',
  'All rights reserved.': 'Tous droits réservés.',
  'Youth Boxing': 'Boxe Éducative',
  'Fitness Boxing': 'Fit Boxing',
  'Competitive Team': 'Section Compétition',
  '1-on-1 Coaching': 'Coaching Privé',
  "Thanks! Your message has been sent - we'll get back to you soon.": "Merci ! Votre message a été envoyé - nous vous répondrons rapidement.",
  'Something went wrong. Please try again or email us directly.': 'Une erreur est survenue. Veuillez réessayer ou nous contacter directement.',
  'Sending…': 'Envoi…',
  'Schedule': 'Horaires',
  'Gallery': 'Galerie',
  'WEEKLY SCHEDULE': 'PLANNING DE LA SEMAINE',
  'FIND YOUR SLOT': 'TROUVEZ VOTRE CRÉNEAU',
  'All sessions are coached. Times may vary during holidays - contact us to confirm.': 'Toutes les séances sont encadrées. Les horaires peuvent varier pendant les vacances - contactez-nous pour confirmer.',
  'Monday': 'Lundi',
  'Tuesday': 'Mardi',
  'Wednesday': 'Mercredi',
  'Thursday': 'Jeudi',
  'Friday': 'Vendredi',
  'Saturday': 'Samedi',
  'Sparring': 'Sparring',
  'Open Sparring': 'Sparring Libre',
  'GALLERY': 'GALERIE',
  'INSIDE THE GYM': 'DANS LA SALLE',
  'Real training, real fighters, real community.': 'Un vrai entraînement, de vrais combattants, une vraie communauté.',
  'Home': 'Accueil',
  'Please complete the security check.': 'Veuillez valider le test de sécurité.',
};

const contactEndpoint = process.env.PCN_CONTACT_ENDPOINT || 'https://pcnboxe-contact-worker.pcnboxe06.workers.dev';
const turnstileSiteKey = process.env.PCN_TURNSTILE_SITE_KEY || '';

function toJsString(str) {
  return "'" + String(str).replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'";
}

function getLogoHtml(basePath) {
  return `<div class="inline-flex items-center gap-3">
    <img src="${basePath}/images/pcn-logo.jpg" alt="PCN - Pugilist Club Niçois" class="h-11 w-11 shrink-0 rounded-xl bg-white object-contain p-0.5 shadow-sm sm:h-12 sm:w-12" />
    <span class="leading-none">
        <span class="block font-display text-xl sm:text-2xl tracking-wide text-white">PCN</span>
        <span class="block text-[10px] sm:text-[11px] font-semibold tracking-[0.35em] text-blue-300">BOXING CLUB</span>
    </span>
</div>`;
}

function renderBlade(bladeContent, locale = 'fr', basePath = '.', cssFileName = 'css.css', jsFileName = 'js.js', pageType = 'home') {
  let html = bladeContent;

  // Handle views extending layouts.page
  if (html.includes("@extends('layouts.page')")) {
    const pageLayoutPath = path.resolve(ROOT_DIR, 'resources/views/layouts/page.blade.php');
    let layoutContent = fs.readFileSync(pageLayoutPath, 'utf8');

    // Extract title
    let titleKey = '';
    if (html.includes("'Schedule'") || html.includes('"Schedule"')) {
      titleKey = 'Schedule';
    } else if (html.includes("'Gallery'") || html.includes('"Gallery"')) {
      titleKey = 'Gallery';
    }
    const pageTitle = locale === 'fr' ? (dictFR[titleKey] || titleKey) : titleKey;

    // Extract content section
    let sectionContent = '';
    const contentMatch = html.match(/@section\(['"]content['"]\)([\s\S]*?)@endsection/);
    if (contentMatch) {
      sectionContent = contentMatch[1];
    }

    layoutContent = layoutContent.replace(/@yield\(['"]title['"]\)/g, pageTitle);
    layoutContent = layoutContent.replace(/@yield\(['"]content['"]\)/g, sectionContent);
    html = layoutContent;
  }

  // 0. Strip Blade server-side comments {{-- ... --}}
  html = html.replace(/\{\{\-\-[\s\S]*?\-\-\}\}/g, '');

  const cssPath = `${basePath}/assets/${cssFileName}`;
  const jsPath = `${basePath}/assets/${jsFileName}`;

  // 1. Replace <x-logo />
  html = html.replace(/<x-logo\s*\/?>/g, getLogoHtml(basePath));

  // 2. Replace @vite directive
  html = html.replace(
    /@vite\(\['resources\/css\/app\.css',\s*'resources\/js\/app\.js'\]\)/g,
    `<link rel="stylesheet" href="${cssPath}">\n        <script type="module" src="${jsPath}"></script>`
  );

  // Replace root asset paths with relative basePath
  html = html.replace(/data-model="\/models\/hero-boxer\.fbx"/g, `data-model="${basePath}/models/hero-boxer.fbx"`);
  html = html.replace(/src="\/images\//g, `src="${basePath}/images/`);
  html = html.replace(/href="\/favicon\.ico"/g, `href="${basePath}/favicon.ico"`);

  // 3. Replace locale function
  html = html.replace(/\{\{\s*str_replace\('_',\s*'-',\s*app\(\)->getLocale\(\)\)\s*\}\}/g, locale);

  // 4. Handle navigation links & language links
  let frLangHref = '#';
  let enLangHref = '#';
  if (pageType === 'home') {
    frLangHref = locale === 'fr' ? '#' : '../';
    enLangHref = locale === 'fr' ? './en/' : '#';
  } else if (pageType === 'horaires') {
    frLangHref = locale === 'fr' ? '#' : '../../horaires/';
    enLangHref = locale === 'fr' ? '../en/horaires/' : '#';
  } else if (pageType === 'galerie') {
    frLangHref = locale === 'fr' ? '#' : '../../galerie/';
    enLangHref = locale === 'fr' ? '../en/galerie/' : '#';
  }

  html = html.replace(/href="\/lang\/fr"/g, `href="${frLangHref}"`);
  html = html.replace(/href="\/lang\/en"/g, `href="${enLangHref}"`);

  if (locale === 'fr') {
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'fr'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-blue-400"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'en'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-white/50 hover:text-white"');
  } else {
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'fr'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-white/50 hover:text-white"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'en'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-blue-400"');
  }

  // Home links (<a href="/">)
  if (pageType === 'home') {
    html = html.replace(/href="\/"/g, 'href="#"');
  } else {
    html = html.replace(/href="\/"/g, 'href="../"');
  }

  // Subpage links (/horaires and /galerie)
  if (pageType === 'home') {
    html = html.replace(/href="\/horaires"/g, 'href="./horaires/"');
    html = html.replace(/href="\/galerie"/g, 'href="./galerie/"');
  } else if (pageType === 'horaires') {
    html = html.replace(/href="\/horaires"/g, 'href="#"');
    html = html.replace(/href="\/galerie"/g, 'href="../galerie/"');
  } else if (pageType === 'galerie') {
    html = html.replace(/href="\/horaires"/g, 'href="../horaires/"');
    html = html.replace(/href="\/galerie"/g, 'href="#"');
  }

  // Join link (/ #join)
  if (pageType === 'home') {
    html = html.replace(/href="\/#join"/g, 'href="#join"');
  } else {
    html = html.replace(/href="\/#join"/g, 'href="../#join"');
  }

  // 5. Unroll @foreach loops
  // Gallery loop
  const galleryLoopRegex = /@foreach\s*\(\$gallery\s+as\s+\$g\)([\s\S]*?)@endforeach/;
  if (galleryLoopRegex.test(html)) {
    const galleryItems = [
      { img: 'prog-team.jpg', span: 'sm:col-span-2 sm:row-span-2' },
      { img: 'gallery-2.jpg', span: '' },
      { img: 'gallery-3.jpg', span: '' },
      { img: 'prog-fitness.jpg', span: '' },
      { img: 'gallery-1.jpg', span: 'sm:row-span-2' },
      { img: 'gallery-4.jpg', span: '' },
      { img: 'prog-youth.jpg', span: '' },
      { img: 'gallery-6.jpg', span: '' },
      { img: 'prog-coaching.jpg', span: '' },
      { img: 'gallery-5.jpg', span: '' },
    ];
    html = html.replace(/@php[\s\S]*?\$gallery\s*=[\s\S]*?@endphp/g, '');
    html = html.replace(galleryLoopRegex, (match, body) => {
      return galleryItems.map((g) => {
        let node = body;
        node = node.replace(/\{\{\s*\$g\['span'\]\s*\}\}/g, g.span);
        node = node.replace(/\{\{\s*\$g\['img'\]\s*\}\}/g, g.img);
        return node;
      }).join('');
    });
  }

  // Schedule classColor legend loop
  const classColorLoopRegex = /@foreach\s*\(\$classColor\s+as\s+\$cls\s+=>\s+\$c\)([\s\S]*?)@endforeach/;
  if (classColorLoopRegex.test(html)) {
    const classColor = {
      'Youth Boxing': { dot: 'bg-blue-500', bar: 'border-blue-500' },
      'Fitness Boxing': { dot: 'bg-sky-400', bar: 'border-sky-400' },
      'Competitive Team': { dot: 'bg-rose-500', bar: 'border-rose-500' },
      '1-on-1 Coaching': { dot: 'bg-violet-500', bar: 'border-violet-500' },
      'Sparring': { dot: 'bg-amber-500', bar: 'border-amber-500' },
      'Open Sparring': { dot: 'bg-amber-500', bar: 'border-amber-500' },
    };
    html = html.replace(classColorLoopRegex, (match, body) => {
      return Object.entries(classColor)
        .filter(([cls]) => cls !== 'Open Sparring')
        .map(([cls, c]) => {
          let node = body.replace(/@continue\([^)]+\)/g, '');
          node = node.replace(/\{\{\s*\$c\['dot'\]\s*\}\}/g, c.dot);
          const translatedCls = locale === 'fr' ? (dictFR[cls] || cls) : cls;
          node = node.replace(/\{\{\s*__\(\$cls\)\s*\}\}/g, translatedCls);
          return node;
        }).join('');
    });
  }

  // Schedule week loop
  if (html.includes('@foreach ($week as $day => $slots)')) {
    const classColor = {
      'Youth Boxing': { dot: 'bg-blue-500', bar: 'border-blue-500' },
      'Fitness Boxing': { dot: 'bg-sky-400', bar: 'border-sky-400' },
      'Competitive Team': { dot: 'bg-rose-500', bar: 'border-rose-500' },
      '1-on-1 Coaching': { dot: 'bg-violet-500', bar: 'border-violet-500' },
      'Sparring': { dot: 'bg-amber-500', bar: 'border-amber-500' },
      'Open Sparring': { dot: 'bg-amber-500', bar: 'border-amber-500' },
    };

    const week = {
      'Monday': [['17h00', 'Youth Boxing'], ['18h30', 'Fitness Boxing'], ['20h00', 'Competitive Team']],
      'Tuesday': [['18h00', 'Fitness Boxing'], ['19h30', '1-on-1 Coaching']],
      'Wednesday': [['14h00', 'Youth Boxing'], ['18h30', 'Fitness Boxing'], ['20h00', 'Sparring']],
      'Thursday': [['18h00', 'Fitness Boxing'], ['19h30', 'Competitive Team']],
      'Friday': [['17h00', 'Youth Boxing'], ['18h30', 'Fitness Boxing'], ['20h00', '1-on-1 Coaching']],
      'Saturday': [['10h00', 'Fitness Boxing'], ['11h30', 'Open Sparring']],
    };

    html = html.replace(/@php[\s\S]*?\$week\s*=[\s\S]*?@endphp/g, '');

    const renderedDays = Object.entries(week).map(([day, slots]) => {
      const translatedDay = locale === 'fr' ? (dictFR[day] || day) : day;
      const dayHeader = translatedDay.toUpperCase();

      const slotsHtml = slots.map((slot) => {
        const time = slot[0];
        const cls = slot[1];
        const bar = classColor[cls] ? classColor[cls].bar : '';
        const translatedCls = locale === 'fr' ? (dictFR[cls] || cls) : cls;
        return `<li class="rounded-lg border-l-4 ${bar} bg-navy-50/70 py-2.5 pl-3 pr-2 transition hover:bg-navy-100/70">
            <span class="block text-[15px] font-bold leading-tight text-navy-900">${time}</span>
            <span class="mt-0.5 block text-xs font-medium text-navy-500">${translatedCls}</span>
        </li>`;
      }).join('\n');

      return `<div class="overflow-hidden rounded-2xl border border-navy-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
          <h3 class="bg-navy-950 py-3.5 text-center font-display text-base tracking-[0.15em] text-white">${dayHeader}</h3>
          <ul class="flex flex-col gap-2.5 p-4">
              ${slotsHtml}
          </ul>
      </div>`;
    }).join('\n');

    const weekContainerRegex = /@foreach\s*\(\$week\s+as\s+\$day\s+=>\s+\$slots\)[\s\S]*?@endforeach\s*<\/ul>\s*<\/div>\s*@endforeach/;
    html = html.replace(weekContainerRegex, renderedDays);
  }

  // Loop for items under ABOUT
  const aboutLoopRegex = /@foreach\s*\(\[\s*'Certified professional coaches',\s*'Beginner to competitive levels',\s*'Fully equipped modern ring',\s*'Structured fight-team pathway',\s*\]\s*as\s*\$i\s*=>\s*\$item\)([\s\S]*?)@endforeach/;
  html = html.replace(aboutLoopRegex, (match, body) => {
    const items = [
      'Certified professional coaches',
      'Beginner to competitive levels',
      'Fully equipped modern ring',
      'Structured fight-team pathway',
    ];
    return items.map((item, i) => {
      let node = body.replace(/\{\{\s*\$i\s*\+\s*2\s*\}\}/g, i + 2);
      node = node.replace(/\{\{\s*__\(\$item\)\s*\}\}/g, locale === 'fr' ? (dictFR[item] || item) : item);
      return node;
    }).join('');
  });

  // Loop for stats
  const statsLoopRegex = /@foreach\s*\(\[\s*\['target'\s*=>\s*50[\s\S]*?\]\s*as\s*\$i\s*=>\s*\$stat\)([\s\S]*?)@endforeach/;
  html = html.replace(statsLoopRegex, (match, body) => {
    const stats = [
      { target: 50, suffix: '+', label: 'Years' },
      { target: 1500, suffix: '+', label: 'Members Trained' },
      { target: 15, suffix: '+', label: 'Classes / Month' },
    ];
    return stats.map((stat, i) => {
      let node = body.replace(/\{\{\s*\$i\s*\+\s*1\s*\}\}/g, i + 1);
      node = node.replace(/\{\{\s*\$stat\['target'\]\s*\}\}/g, stat.target);
      node = node.replace(/\{\{\s*\$stat\['suffix'\]\s*\}\}/g, stat.suffix);
      node = node.replace(/\{\{\s*__\(\$stat\['label'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[stat.label] || stat.label) : stat.label);
      return node;
    }).join('');
  });

  // Loop for program cards
  const cardsLoopRegex = /@foreach\s*\(\[\s*\['img'\s*=>\s*'\/images\/prog-youth\.jpg'[\s\S]*?\]\s*as\s*\$i\s*=>\s*\$card\)([\s\S]*?)@endforeach/;
  html = html.replace(cardsLoopRegex, (match, body) => {
    const cards = [
      { img: `${basePath}/images/prog-youth.jpg`, title: 'Youth Boxing', desc: 'Ages 8-16 build footwork, discipline and confidence with age-matched coaching.', tag: 'Ages 8-16' },
      { img: `${basePath}/images/prog-fitness.jpg`, title: 'Fitness Boxing', desc: 'High-energy pad and bag rounds that torch calories and sharpen technique.', tag: 'All Levels' },
      { img: `${basePath}/images/prog-team.jpg`, title: 'Competitive Team', desc: 'Sparring, conditioning and fight-camp prep for our amateur roster.', tag: 'By Trial' },
      { img: `${basePath}/images/prog-coaching.jpg`, title: '1-on-1 Coaching', desc: 'Private sessions dialed into your goals - form, power, or fight prep.', tag: 'Private' },
    ];
    return cards.map((card, i) => {
      let node = body.replace(/\{\{\s*\$i\s*\+\s*1\s*\}\}/g, i + 1);
      node = node.replace(/\{\{\s*\$card\['img'\]\s*\}\}/g, card.img);
      node = node.replace(/\{\{\s*__\(\$card\['title'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[card.title] || card.title) : card.title);
      node = node.replace(/\{\{\s*mb_strtoupper\(__\(\$card\['title'\]\),\s*'UTF-8'\)\s*\}\}/g, (locale === 'fr' ? (dictFR[card.title] || card.title) : card.title).toUpperCase());
      node = node.replace(/\{\{\s*__\(\$card\['tag'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[card.tag] || card.tag) : card.tag);
      node = node.replace(/\{\{\s*__\(\$card\['desc'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[card.desc] || card.desc) : card.desc);
      return node;
    }).join('');
  });

  // Loop for location details
  const locationLoopRegex = /@foreach\s*\(\[\s*\['icon'\s*=>\s*'pin'[\s\S]*?\]\s*as\s*\$item\)([\s\S]*?)@endforeach/;
  html = html.replace(locationLoopRegex, (match, body) => {
    const items = [
      { icon: 'pin', label: 'Address', value: '16 rue Fornéro Méneï, 06300 Nice' },
      { icon: 'phone', label: 'Phone', value: '06 58 97 80 75' },
      { icon: 'clock', label: 'Hours', value: 'Mon-Fri · 5pm-8pm' },
    ];
    return items.map((item) => {
      let node = body;
      node = node.replace(/@switch\(\$item\['icon'\]\)[\s\S]*?@endswitch/, () => {
        if (item.icon === 'pin') return '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.1-7-11a7 7 0 1114 0c0 4.9-7 11-7 11z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>';
        if (item.icon === 'phone') return '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M4 5c0 8.3 6.7 15 15 15l3-4-6-3-2 2c-2.5-1.2-4.8-3.5-6-6l2-2-3-6z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>';
        return '<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>';
      });
      node = node.replace(/\{\{\s*__\(\$item\['label'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[item.label] || item.label) : item.label);
      node = node.replace(/\{\{\s*__\(\$item\['value'\]\)\s*\}\}/g, locale === 'fr' ? (dictFR[item.value] || item.value) : item.value);
      return node;
    }).join('');
  });

  // Loop for courses & pricing
  const coursesLoopRegex = /@foreach\s*\(\[\s*\['name'\s*=>\s*'Boxing · Adults'[\s\S]*?\]\s*as\s*\$course\)([\s\S]*?)@endforeach/;
  html = html.replace(coursesLoopRegex, (match, body) => {
    const courses = [
      { name: 'Boxing · Adults', desc: 'All levels · technique &amp; sparring', price: '250' },
      { name: 'Youth School (8-16)', desc: 'Dedicated junior coaching', price: '200' },
      { name: 'Fit Boxing', desc: 'Cardio · conditioning · pads', price: '220' },
    ];
    return courses.map((course) => {
      let node = body;
      node = node.replace(/\{\{\s*mb_strtoupper\(__\(\$course\['name'\]\),\s*'UTF-8'\)\s*\}\}/g, (locale === 'fr' ? (dictFR[course.name] || course.name) : course.name).toUpperCase());
      node = node.replace(/\{\!\!\s*__\(\$course\['desc'\]\)\s*\!\!\}/g, locale === 'fr' ? (dictFR[course.desc] || course.desc) : course.desc);
      node = node.replace(/\{\{\s*\$course\['price'\]\s*\}\}/g, course.price);
      return node;
    }).join('');
  });

  // Loop for social icons in footer
  const socialLoopRegex = /@foreach\s*\(\['instagram',\s*'facebook',\s*'youtube'\]\s*as\s*\$social\)([\s\S]*?)@endforeach/;
  html = html.replace(socialLoopRegex, (match, body) => {
    const socials = ['instagram', 'facebook', 'youtube'];
    return socials.map((social) => {
      if (social === 'instagram') {
        return `<a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition hover:border-blue-400 hover:text-blue-400"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg></a>`;
      } else if (social === 'facebook') {
        return `<a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition hover:border-blue-400 hover:text-blue-400"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3c-2 0-3.5 1.5-3.5 3.5V12H8v3h2.5v6h3v-6H16l.5-3h-3v-1.5c0-.6.4-1.5 1.5-1.5z" fill="currentColor"/></svg></a>`;
      } else {
        return `<a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition hover:border-blue-400 hover:text-blue-400"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="6" width="18" height="12" rx="3" stroke="currentColor" stroke-width="1.8"/><path d="M10 9.5l5 2.5-5 2.5z" fill="currentColor"/></svg></a>`;
      }
    }).join('');
  });

  // 6. Clean up remaining Blade directives & @js directives
  if (turnstileSiteKey) {
    html = html.replace(/@if\s*\(\s*config\(['"]pcn\.turnstile_site_key['"]\)\s*\)([\s\S]*?)@endif/g, (match, body) => {
      return body.replace(/\{\{\s*config\(['"]pcn\.turnstile_site_key['"]\)\s*\}\}/g, turnstileSiteKey);
    });
  } else {
    html = html.replace(/@if\s*\(\s*config\(['"]pcn\.turnstile_site_key['"]\)\s*\)[\s\S]*?@endif/g, '');
  }

  html = html.replace(/@js\(\s*\(bool\)\s*config\(['"]pcn\.turnstile_site_key['"]\)\s*\)/g, turnstileSiteKey ? 'true' : 'false');
  html = html.replace(/@js\(\s*config\(['"]pcn\.contact_endpoint['"]\)\s*\)/g, toJsString(contactEndpoint));
  html = html.replace(/@js\(\s*__\((['"])([\s\S]*?)\1\)\s*\)/g, (match, q, key) => {
    const text = locale === 'fr' ? (dictFR[key] || key) : key;
    return toJsString(text);
  });
  html = html.replace(/@js\((['"])([\s\S]*?)\1\)/g, (match, q, str) => {
    return toJsString(str);
  });

  html = html.replace(
    /<form x-show="!\s*sent" @submit\.prevent="submit"/g,
    '<form x-show="! sent" @submit.prevent="submit" action="#" onsubmit="return false;"'
  );

  html = html.replace(/@csrf/g, '');
  html = html.replace(/\{\{\s*date\('Y'\)\s*\}\}/g, new Date().getFullYear().toString());
  html = html.replace(/action="\{\{\s*route\('contact'\)\s*\}\}"/g, 'action="#" id="contact-form"');
  html = html.replace(/value="\{\{\s*old\('name'\)\s*\}\}"/g, '');
  html = html.replace(/value="\{\{\s*old\('phone'\)\s*\}\}"/g, '');
  html = html.replace(/value="\{\{\s*old\('email'\)\s*\}\}"/g, '');
  html = html.replace(/\{\{\s*old\('message'\)\s*\}\}/g, '');
  html = html.replace(/@error\('[^']+'\)[\s\S]*?@enderror/g, '');

  // Session banner replacement
  html = html.replace(
    /@if\s*\(\s*session\('contact_sent'\)\s*\)[\s\S]*?@endif/g,
    `<div id="form-success-banner" class="hidden mb-6 flex items-center gap-3 rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-700 ring-1 ring-green-200">
        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        ${locale === 'fr' ? dictFR["Thanks! Your message has been sent - we'll get back to you soon."] : "Thanks! Your message has been sent - we'll get back to you soon."}
    </div>`
  );

  // Translate all remaining {{ __('Key') }} or {!! __('Key') !!}
  html = html.replace(/\{\!\!\s*__\((['"])([\s\S]*?)\1\)\s*\!\!\}/g, (match, q, key) => {
    return locale === 'fr' ? (dictFR[key] || key) : key;
  });
  html = html.replace(/\{\{\s*__\((['"])([\s\S]*?)\1\)\s*\}\}/g, (match, q, key) => {
    return locale === 'fr' ? (dictFR[key] || key) : key;
  });

  return html;
}

async function run() {
  console.log('📦 Starting PCN static site build...');

  await fs.remove(DIST_DIR);
  await fs.ensureDir(DIST_DIR);

  // 1. Read Blade source templates
  const welcomeBladePath = path.resolve(ROOT_DIR, 'resources/views/welcome.blade.php');
  const scheduleBladePath = path.resolve(ROOT_DIR, 'resources/views/schedule.blade.php');
  const galleryBladePath = path.resolve(ROOT_DIR, 'resources/views/gallery.blade.php');

  const welcomeBladeSource = await fs.readFile(welcomeBladePath, 'utf8');
  const scheduleBladeSource = await fs.readFile(scheduleBladePath, 'utf8');
  const galleryBladeSource = await fs.readFile(galleryBladePath, 'utf8');

  // 2. Render initial static HTML templates to dist/ so Tailwind content-scanner picks up all classes
  console.log('🇫🇷 Generating French static HTML templates...');
  await fs.writeFile(path.join(DIST_DIR, 'index.html'), renderBlade(welcomeBladeSource, 'fr', '.', 'css.css', 'js.js', 'home'), 'utf8');

  await fs.ensureDir(path.join(DIST_DIR, 'horaires'));
  await fs.writeFile(path.join(DIST_DIR, 'horaires', 'index.html'), renderBlade(scheduleBladeSource, 'fr', '..', 'css.css', 'js.js', 'horaires'), 'utf8');

  await fs.ensureDir(path.join(DIST_DIR, 'galerie'));
  await fs.writeFile(path.join(DIST_DIR, 'galerie', 'index.html'), renderBlade(galleryBladeSource, 'fr', '..', 'css.css', 'js.js', 'galerie'), 'utf8');

  console.log('🇬🇧 Generating English static HTML templates...');
  await fs.ensureDir(path.join(DIST_DIR, 'en'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'index.html'), renderBlade(welcomeBladeSource, 'en', '..', 'css.css', 'js.js', 'home'), 'utf8');

  await fs.ensureDir(path.join(DIST_DIR, 'en', 'horaires'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'horaires', 'index.html'), renderBlade(scheduleBladeSource, 'en', '../..', 'css.css', 'js.js', 'horaires'), 'utf8');

  await fs.ensureDir(path.join(DIST_DIR, 'en', 'galerie'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'galerie', 'index.html'), renderBlade(galleryBladeSource, 'en', '../..', 'css.css', 'js.js', 'galerie'), 'utf8');

  // 3. Copy public assets
  const publicDir = path.resolve(ROOT_DIR, 'public');
  if (await fs.pathExists(publicDir)) {
    console.log('📂 Copying public assets...');
    await fs.copy(publicDir, DIST_DIR, {
      filter: (src) => !src.endsWith('index.php') && !src.endsWith('.htaccess'),
    });
  }

  // 4. Build CSS and JS using Vite
  console.log('⚡ Compiling CSS & JS with Vite...');
  await viteBuild({
    configFile: path.resolve(__dirname, 'vite.config.js'),
  });

  // Find generated assets
  const assetsDir = path.join(DIST_DIR, 'assets');
  const assetFiles = await fs.readdir(assetsDir);
  const cssFile = assetFiles.find((f) => f.endsWith('.css'));
  const jsFile = assetFiles.find((f) => f.endsWith('.js'));

  // 5. Replace final hashed asset paths in output HTML files
  console.log('🔗 Injecting asset paths...');

  // FR Home
  await fs.writeFile(path.join(DIST_DIR, 'index.html'), renderBlade(welcomeBladeSource, 'fr', '.', cssFile, jsFile, 'home'), 'utf8');

  // FR Horaires
  const finalHorairesFR = renderBlade(scheduleBladeSource, 'fr', '..', cssFile, jsFile, 'horaires');
  await fs.ensureDir(path.join(DIST_DIR, 'horaires'));
  await fs.writeFile(path.join(DIST_DIR, 'horaires', 'index.html'), finalHorairesFR, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'horaires.html'), finalHorairesFR, 'utf8');
  await fs.ensureDir(path.join(DIST_DIR, 'schedule'));
  await fs.writeFile(path.join(DIST_DIR, 'schedule', 'index.html'), finalHorairesFR, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'schedule.html'), finalHorairesFR, 'utf8');

  // FR Galerie
  const finalGalerieFR = renderBlade(galleryBladeSource, 'fr', '..', cssFile, jsFile, 'galerie');
  await fs.ensureDir(path.join(DIST_DIR, 'galerie'));
  await fs.writeFile(path.join(DIST_DIR, 'galerie', 'index.html'), finalGalerieFR, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'galerie.html'), finalGalerieFR, 'utf8');
  await fs.ensureDir(path.join(DIST_DIR, 'gallery'));
  await fs.writeFile(path.join(DIST_DIR, 'gallery', 'index.html'), finalGalerieFR, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'gallery.html'), finalGalerieFR, 'utf8');

  // EN Home
  await fs.writeFile(path.join(DIST_DIR, 'en', 'index.html'), renderBlade(welcomeBladeSource, 'en', '..', cssFile, jsFile, 'home'), 'utf8');

  // EN Horaires
  const finalHorairesEN = renderBlade(scheduleBladeSource, 'en', '../..', cssFile, jsFile, 'horaires');
  await fs.ensureDir(path.join(DIST_DIR, 'en', 'horaires'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'horaires', 'index.html'), finalHorairesEN, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'en', 'horaires.html'), finalHorairesEN, 'utf8');
  await fs.ensureDir(path.join(DIST_DIR, 'en', 'schedule'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'schedule', 'index.html'), finalHorairesEN, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'en', 'schedule.html'), finalHorairesEN, 'utf8');

  // EN Galerie
  const finalGalerieEN = renderBlade(galleryBladeSource, 'en', '../..', cssFile, jsFile, 'galerie');
  await fs.ensureDir(path.join(DIST_DIR, 'en', 'galerie'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'galerie', 'index.html'), finalGalerieEN, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'en', 'galerie.html'), finalGalerieEN, 'utf8');
  await fs.ensureDir(path.join(DIST_DIR, 'en', 'gallery'));
  await fs.writeFile(path.join(DIST_DIR, 'en', 'gallery', 'index.html'), finalGalerieEN, 'utf8');
  await fs.writeFile(path.join(DIST_DIR, 'en', 'gallery.html'), finalGalerieEN, 'utf8');

  // 6. Write Cloudflare Pages _redirects file
  const redirectsContent = `/gallery /galerie 301
/schedule /horaires 301
/en/gallery /en/galerie 301
/en/schedule /en/horaires 301
`;
  await fs.writeFile(path.join(DIST_DIR, '_redirects'), redirectsContent, 'utf8');

  console.log('✅ Static build complete! Output directory: static_exporter/dist');
}

run().catch((err) => {
  console.error('❌ Build failed:', err);
  process.exit(1);
});
