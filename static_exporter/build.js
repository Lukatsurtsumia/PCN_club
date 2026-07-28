import fs from 'fs-extra';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { build as viteBuild } from 'vite';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const ROOT_DIR = path.resolve(__dirname, '..');
const DIST_DIR = path.resolve(__dirname, 'dist');

// French translations (default app locale is FR)
const dictFR = {
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
  'Sparring, conditioning and fight-camp prep for our amateur roster.': 'Mises en gants, préparation physique et suivi personnalisé pour la compétition.',
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
};

function getLogoHtml(basePath) {
  return `<div class="inline-flex items-center gap-3">
    <img src="${basePath}/images/pcn-logo.jpg" alt="PCN - Pugilist Club Niçois" class="h-11 w-11 shrink-0 rounded-xl bg-white object-contain p-0.5 shadow-sm sm:h-12 sm:w-12" />
    <span class="leading-none">
        <span class="block font-display text-xl sm:text-2xl tracking-wide text-white">PCN</span>
        <span class="block text-[10px] sm:text-[11px] font-semibold tracking-[0.35em] text-blue-300">BOXING CLUB</span>
    </span>
</div>`;
}

function renderBlade(bladeContent, locale = 'fr', basePath = '.', cssFileName = 'css.css', jsFileName = 'js.js') {
  let html = bladeContent;

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

  // 3. Replace locale function
  html = html.replace(/\{\{\s*str_replace\('_',\s*'-',\s*app\(\)->getLocale\(\)\)\s*\}\}/g, locale);

  // 4. Handle language links
  if (locale === 'fr') {
    html = html.replace(/href="\/lang\/fr"/g, 'href="#"');
    html = html.replace(/href="\/lang\/en"/g, 'href="./en/"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'fr'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-blue-400"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'en'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-white/50 hover:text-white"');
  } else {
    html = html.replace(/href="\/lang\/fr"/g, 'href="../"');
    html = html.replace(/href="\/lang\/en"/g, 'href="#"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'fr'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-white/50 hover:text-white"');
    html = html.replace(/class="\{\{\s*app\(\)->getLocale\(\)\s*===\s*'en'\s*\?\s*'text-blue-400'\s*:\s*'text-white\/50(?:\s+hover:text-white)?'\s*\}\}"/g, 'class="text-blue-400"');
  }

  // 5. Unroll @foreach loops
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
      { icon: 'phone', label: 'Phone', value: '04 93 89 05 09' },
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

  // 6. Clean up remaining Blade directives
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

  // 1. Read Blade source template
  const welcomeBladePath = path.resolve(ROOT_DIR, 'resources/views/welcome.blade.php');
  const bladeSource = await fs.readFile(welcomeBladePath, 'utf8');

  // 2. Render initial static HTML templates to dist/ so Tailwind content-scanner picks up all classes
  console.log('🇫🇷 Generating French static HTML template...');
  const htmlFRTemplate = renderBlade(bladeSource, 'fr', '.', 'css.css', 'js.js');
  await fs.writeFile(path.join(DIST_DIR, 'index.html'), htmlFRTemplate, 'utf8');

  console.log('🇬🇧 Generating English static HTML template...');
  await fs.ensureDir(path.join(DIST_DIR, 'en'));
  const htmlENTemplate = renderBlade(bladeSource, 'en', '..', 'css.css', 'js.js');
  await fs.writeFile(path.join(DIST_DIR, 'en', 'index.html'), htmlENTemplate, 'utf8');

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

  // 5. Replace final hashed asset paths in dist/index.html & dist/en/index.html
  console.log('🔗 Injecting asset paths...');
  const finalHtmlFR = renderBlade(bladeSource, 'fr', '.', cssFile, jsFile);
  await fs.writeFile(path.join(DIST_DIR, 'index.html'), finalHtmlFR, 'utf8');

  const finalHtmlEN = renderBlade(bladeSource, 'en', '..', cssFile, jsFile);
  await fs.writeFile(path.join(DIST_DIR, 'en', 'index.html'), finalHtmlEN, 'utf8');

  console.log('✅ Static build complete! Output directory: static_exporter/dist');
}

run().catch((err) => {
  console.error('❌ Build failed:', err);
  process.exit(1);
});
