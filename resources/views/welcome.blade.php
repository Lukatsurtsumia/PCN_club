<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- stop browsers auto-translating the site (it garbles the FR nav); use the built-in FR/EN switch instead --}}
        <meta name="google" content="notranslate">
        <meta name="description" content="Pugilist Club Niçois - club de boxe anglaise à Nice depuis 1969. Boxe jeunesse, fitness, compétition et coaching privé.">

        <title>Pugilist Club Niçois | Boxe Anglaise à Nice</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- start the CDN connection early: reviews widget --}}
        <link rel="dns-prefetch" href="https://elfsightcdn.com">
        <link rel="dns-prefetch" href="https://static.elfsight.com">
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Cloudflare Turnstile (spam protection) — only loaded when a Site Key is configured --}}
        @if (config('pcn.turnstile_site_key'))
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        @endif
    </head>
    <body class="font-body bg-white text-navy-950 antialiased">

        {{-- ============================= HEADER ============================= --}}
        <header
            x-data="navMenu()"
            :class="scrolled ? 'bg-navy-950/90 backdrop-blur-md py-2 shadow-lg shadow-black/20' : 'bg-transparent py-4'"
            class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 lg:px-10">
                <a href="#home" class="relative z-10">
                    <x-logo />
                </a>

                <nav class="hidden items-center gap-6 lg:flex">
                    <a href="#about" class="nav-underline text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('About') }}</a>
                    <a href="/horaires" class="nav-underline text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Schedule') }}</a>
                    <a href="/galerie" class="nav-underline text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Gallery') }}</a>
                    <a href="#testimonials" class="nav-underline text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Fighters Say') }}</a>
                    <a href="#location" class="nav-underline text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Location') }}</a>
                    <a href="#join" class="rounded-full bg-blue-600 px-6 py-2.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">
                        {{ __('Join The Fight') }}
                    </a>
                    <span class="flex items-center gap-1.5 text-xs font-bold tracking-wide">
                        <a href="/lang/fr" class="{{ app()->getLocale() === 'fr' ? 'text-blue-400' : 'text-white/50 hover:text-white' }}">FR</a>
                        <span class="text-white/25">/</span>
                        <a href="/lang/en" class="{{ app()->getLocale() === 'en' ? 'text-blue-400' : 'text-white/50 hover:text-white' }}">EN</a>
                    </span>
                </nav>

                <button @click="open = !open" class="relative z-10 flex h-10 w-10 flex-col items-center justify-center gap-1.5 lg:hidden" aria-label="Toggle menu">
                    <span class="h-0.5 w-6 bg-white transition" :class="open && 'translate-y-2 rotate-45'"></span>
                    <span class="h-0.5 w-6 bg-white transition" :class="open && 'opacity-0'"></span>
                    <span class="h-0.5 w-6 bg-white transition" :class="open && '-translate-y-2 -rotate-45'"></span>
                </button>
            </div>

            {{-- mobile panel --}}
            <div x-show="open" x-transition x-cloak @click.outside="close()" class="mx-4 mt-4 rounded-2xl bg-navy-900 p-6 shadow-xl lg:hidden">
                <nav class="flex flex-col gap-5">
                    <a @click="close()" href="#about" class="text-base font-semibold text-white/90">{{ __('About') }}</a>
                    <a @click="close()" href="/horaires" class="text-base font-semibold text-white/90">{{ __('Schedule') }}</a>
                    <a @click="close()" href="/galerie" class="text-base font-semibold text-white/90">{{ __('Gallery') }}</a>
                    <a @click="close()" href="#testimonials" class="text-base font-semibold text-white/90">{{ __('Fighters Say') }}</a>
                    <a @click="close()" href="#location" class="text-base font-semibold text-white/90">{{ __('Location') }}</a>
                    <a @click="close()" href="#join" class="rounded-full bg-blue-600 px-6 py-3 text-center text-base font-bold text-white">{{ __('Join The Fight') }}</a>
                    <span class="flex items-center justify-center gap-2 pt-1 text-sm font-bold">
                        <a href="/lang/fr" class="{{ app()->getLocale() === 'fr' ? 'text-blue-400' : 'text-white/50' }}">FR</a>
                        <span class="text-white/25">/</span>
                        <a href="/lang/en" class="{{ app()->getLocale() === 'en' ? 'text-blue-400' : 'text-white/50' }}">EN</a>
                    </span>
                </nav>
            </div>

            {{-- ring-rope bottom border: the header's signature detail --}}
            <div class="pointer-events-none absolute inset-x-0 -bottom-2 flex justify-center gap-1.5 px-4 opacity-80">
                <span class="h-[3px] w-full max-w-7xl rounded-full bg-gradient-to-r from-transparent via-blue-500 to-transparent"></span>
            </div>
        </header>

        {{-- ============================= HERO SLIDESHOW ============================= --}}
        <section
            id="home"
            x-data="heroSlider(3, 6000)"
            @mouseenter="stop()"
            @mouseleave="play()"
            @touchstart.passive="touchStart($event)"
            @touchend.passive="touchEnd($event)"
            class="relative h-screen min-h-[680px] w-full overflow-hidden bg-navy-950"
        >
            {{-- background layer - slide 1 --}}
            <div x-show="active === 0" x-transition:enter="transition ease-out duration-[400ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-[400ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_theme(colors.navy.700),_theme(colors.navy.950)_65%)]"></div>
            </div>

            {{-- background layer - slide 2 --}}
            <div x-show="active === 1" x-transition:enter="transition ease-out duration-[400ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-[400ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_bottom_left,_theme(colors.navy.700),_theme(colors.navy.950)_65%)]"></div>
                <div class="absolute inset-x-0 top-1/3 flex flex-col gap-6 opacity-40">
                    <span class="h-1 w-full bg-blue-500"></span>
                    <span class="h-1 w-full bg-white/60"></span>
                    <span class="h-1 w-full bg-blue-500"></span>
                </div>
                <div class="absolute -left-16 bottom-0 h-[30rem] w-[30rem] rounded-full bg-blue-600/20 blur-3xl animate-ring-pulse"></div>
            </div>

            {{-- background layer - slide 3 --}}
            <div x-show="active === 2" x-transition:enter="transition ease-out duration-[400ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-[400ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_theme(colors.navy.700),_theme(colors.navy.950)_65%)]"></div>
            </div>

            {{-- ===== full-bleed hero background video (replaces the 3D fighter) ===== --}}
            <video autoplay muted loop playsinline preload="auto"
                   class="pointer-events-none absolute inset-0 z-[2] h-full w-full object-cover">
                <source src="/videos/hero.mp4" type="video/mp4">
            </video>
            {{-- readability overlays so the headline stays crisp over the video --}}
            <div class="pointer-events-none absolute inset-0 z-[5] bg-gradient-to-r from-navy-950/90 via-navy-950/55 to-navy-950/25"></div>
            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[5] h-40 bg-gradient-to-t from-navy-950 via-navy-950/60 to-transparent"></div>

            {{-- content --}}
            <div class="relative z-10 mx-auto flex h-full max-w-7xl items-center px-6 lg:px-10">
                <template x-if="active === 0">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('ENGLISH BOXING CLUB IN NICE SINCE 1969') }}</span>
                        <h1 class="font-display text-5xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-6xl lg:text-7xl">{{ __('ENGLISH BOXING CLUB') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('IN NICE') }}</span></h1>
                        <p class="mt-6 max-w-lg text-lg text-white/70">{{ __('Since 1969, Pugilist Club Niçois has offered English boxing classes in Nice for children, teens, and adults, from recreational to competitive levels.') }}</p>
                        <div class="mt-9 flex flex-wrap gap-4">
                            <a href="#join" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
                            <a href="#explore" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold tracking-wide text-white transition hover:border-white hover:bg-white/10">{{ __('View Programs') }}</a>
                        </div>
                    </div>
                </template>

                <template x-if="active === 1">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('EVERY ROUND COUNTS') }}</span>
                        <h1 class="font-display text-5xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-6xl lg:text-7xl">{{ __('DISCIPLINE.') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('POWER.') }}</span> {{ __('PRECISION.') }}</h1>
                        <p class="mt-6 max-w-lg text-lg text-white/70">{{ __('Pugilist Club Niçois is the historic English boxing club in Nice. Our coaches guide beginners, recreational boxers, and competitors in a gym fully dedicated to boxing.') }}</p>
                        <div class="mt-9 flex flex-wrap gap-4">
                            <a href="#join" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
                            <a href="#about" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold tracking-wide text-white transition hover:border-white hover:bg-white/10">{{ __('Our Story') }}</a>
                        </div>
                    </div>
                </template>

                <template x-if="active === 2">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('WHY PCN') }}</span>
                        <h1 class="font-display text-4xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-5xl lg:text-6xl">{{ __('WHY CHOOSE') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('PUGILIST CLUB NIÇOIS?') }}</span></h1>
                        <ul class="mt-6 grid grid-cols-1 gap-2.5 sm:grid-cols-2 text-base text-white/80">
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Historic club founded in 1969') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Affiliated with the French Boxing Federation') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Kids classes from age 7') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Recreational boxing') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Competitive boxing') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Physical conditioning') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Salle Serge Leyrit in Nice') }}</li>
                            <li class="flex items-center gap-2 font-medium"><span class="text-blue-400 font-bold">✓</span> {{ __('Lady boxing') }}</li>
                        </ul>
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="#join" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
                            <a href="#location" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold tracking-wide text-white transition hover:border-white hover:bg-white/10">{{ __('Find The Gym') }}</a>
                        </div>
                    </div>
                </template>
            </div>

            {{-- controls --}}
            <div class="absolute inset-x-0 bottom-8 z-10 flex items-center justify-center gap-6">
                <button @click="prev()" class="hidden h-11 w-11 items-center justify-center rounded-full border border-white/25 text-white transition hover:bg-white/10 sm:flex" aria-label="Previous slide">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="flex items-center gap-3">
                    <template x-for="i in 3" :key="i">
                        <button @click="goTo(i - 1)" :class="active === i - 1 ? 'w-8 bg-blue-500' : 'w-2.5 bg-white/30'" class="h-2.5 rounded-full transition-all duration-300" :aria-label="'Go to slide ' + i"></button>
                    </template>
                </div>
                <button @click="next()" class="hidden h-11 w-11 items-center justify-center rounded-full border border-white/25 text-white transition hover:bg-white/10 sm:flex" aria-label="Next slide">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>

            <div class="absolute bottom-8 right-8 z-10 hidden flex-col items-center gap-2 text-white/50 md:flex">
                <span class="text-[10px] font-semibold tracking-[0.3em]">SCROLL</span>
                <span class="h-10 w-px animate-pulse bg-white/40"></span>
            </div>
        </section>

        {{-- ============================= ABOUT ============================= --}}
        <section id="about" class="scroll-mt-24 bg-white py-24 sm:py-32">
            <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-16 px-6 lg:grid-cols-2 lg:px-10">
                <div data-reveal="left" class="relative">
                    <div class="relative aspect-[4/5] w-full max-w-md overflow-hidden rounded-3xl bg-gradient-to-br from-navy-800 to-navy-950 shadow-2xl">
                        <div class="absolute inset-0 opacity-20 [background-image:radial-gradient(circle,_white_1px,_transparent_1px)] [background-size:16px_16px]"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-7 p-10">
                            <div class="rounded-3xl bg-white p-6 shadow-xl ring-1 ring-black/5">
                                <img src="/images/pcn-logo.jpg" alt="PCN - Pugilist Club Niçois" class="mx-auto w-48 object-contain sm:w-56" />
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold uppercase tracking-[0.35em] text-white">Nice &middot; France</p>
                                <p class="mt-2 text-[11px] font-semibold uppercase tracking-[0.25em] text-blue-300">Pugilist Club Niçois</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-8 -right-6 flex items-center gap-4 rounded-2xl bg-white px-6 py-4 shadow-xl ring-1 ring-black/5 sm:-right-10">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-600/30">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24"><path d="M12 2l2.9 6.3 6.8.7-5.1 4.6 1.4 6.7L12 17.8 6 20.9l1.4-6.7-5.1-4.6 6.8-.7z"/></svg>
                        </span>
                        <span class="leading-none">
                            <span class="block text-[10px] font-bold uppercase tracking-[0.3em] text-navy-500">Depuis</span>
                            <span class="mt-1.5 block font-display text-3xl tracking-wide text-blue-600">1969</span>
                        </span>
                    </div>
                    <div class="absolute -left-6 -top-6 h-24 w-24 rounded-full border-4 border-blue-500/30 sm:-left-10 sm:-top-10"></div>
                </div>

                <div>
                    <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-600">{{ __('ABOUT THE CLUB') }}</span>
                    <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl leading-tight tracking-wide text-navy-950 sm:text-5xl">{{ __('MORE THAN A BOXING CLUB,') }} <br class="hidden sm:block" />{{ __('A FAMILY.') }}</h2>
                    <div data-reveal="up" data-reveal-delay="2" class="mt-6 max-w-xl space-y-4 text-base sm:text-lg leading-relaxed text-navy-700/80">
                        <p>{{ __("Founded in 1969, Pugilist Club Niçois is the oldest English boxing club in Nice. A historical cornerstone of boxing in Nice, the club has passed on the values of respect, discipline, pushing one's limits, and passion for over 50 years.") }}</p>
                        <p>{{ __('Today, the club is experiencing a fresh momentum driven by a new Board of Directors, committed to preserving its heritage while developing new projects to pass on the passion for boxing to future generations.') }}</p>
                        <p class="font-semibold text-navy-950">{{ __('Join Pugilist Club Niçois, the historic English boxing club in Nice, and discover a facility where experience, high standards, well-being, and passion are handed down from generation to generation.') }}</p>
                    </div>

                    <ul class="mt-8 grid max-w-xl grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach ([
                            'Certified professional coaches',
                            'Beginner to competitive levels',
                            'Fully equipped modern ring',
                            'Structured fight-team pathway',
                        ] as $i => $item)
                            <li data-reveal="up" data-reveal-delay="{{ $i + 2 }}" class="flex items-center gap-3 text-sm font-medium text-navy-800">
                                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                {{ __($item) }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-12 grid max-w-md grid-cols-2 gap-6 border-t border-navy-100 pt-8">
                        @foreach ([
                            ['target' => 55, 'suffix' => '+', 'label' => 'Years'],
                            ['target' => 3000, 'suffix' => '+', 'label' => 'Members Trained'],
                        ] as $i => $stat)
                            <div data-reveal="scale" data-reveal-delay="{{ $i + 1 }}">
                                <div class="font-display text-3xl text-navy-950 sm:text-4xl">
                                    <span data-counter="{{ $stat['target'] }}" data-counter-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</span>
                                </div>
                                <div class="mt-1 text-xs font-semibold uppercase tracking-wide text-navy-500">{{ __($stat['label']) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================= EXPLORE (schedule + gallery cards) ============================= --}}
        <section id="explore" class="scroll-mt-24 bg-navy-950 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mx-auto max-w-2xl text-center">
                    <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-400">{{ __('DISCOVER') }}</span>
                    <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">{{ __('EXPLORE THE CLUB') }}</h2>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2">
                    {{-- Schedule card --}}
                    <a href="/horaires" data-reveal="left" class="group relative flex h-80 items-end overflow-hidden rounded-3xl shadow-xl ring-1 ring-white/10 transition duration-500 hover:-translate-y-2 hover:shadow-glow">
                        <img src="/images/gallery-3.jpg" alt="{{ __('Schedule') }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/55 to-navy-950/10"></div>
                        <div class="relative z-10 p-8">
                            <span class="text-xs font-bold tracking-[0.3em] text-blue-400">{{ __('WEEKLY SCHEDULE') }}</span>
                            <h3 class="mt-2 font-display text-3xl tracking-wide text-white sm:text-4xl">{{ __('Schedule') }}</h3>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-white transition group-hover:gap-3">
                                {{ __('View the schedule') }}
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>

                    {{-- Gallery card --}}
                    <a href="/galerie" data-reveal="right" class="group relative flex h-80 items-end overflow-hidden rounded-3xl shadow-xl ring-1 ring-white/10 transition duration-500 hover:-translate-y-2 hover:shadow-glow">
                        <img src="/images/prog-team.jpg" alt="{{ __('Gallery') }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/55 to-navy-950/10"></div>
                        <div class="relative z-10 p-8">
                            <span class="text-xs font-bold tracking-[0.3em] text-blue-400">{{ __('GALLERY') }}</span>
                            <h3 class="mt-2 font-display text-3xl tracking-wide text-white sm:text-4xl">{{ __('Gallery') }}</h3>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-white transition group-hover:gap-3">
                                {{ __('View the gallery') }}
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        {{-- ============================= TESTIMONIALS (auto-scroll) ============================= --}}
        <section id="testimonials" class="scroll-mt-24 bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 text-center lg:px-10">
                <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-600">{{ __('FIGHTERS SAY') }}</span>
                <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl tracking-wide text-navy-950 sm:text-5xl">{{ __('REAL PEOPLE. REAL RESULTS.') }}</h2>
            </div>

            {{-- Live Google reviews via Elfsight - loads only after cookie consent --}}
            <div data-reveal="up" data-reveal-delay="2" x-data class="mx-auto mt-12 max-w-7xl px-6 lg:px-10">
                <template x-if="$store.consent.accepted()">
                    <div x-data="reviewsWidget()">
                        {{-- loading spinner --}}
                        <div x-show="state === 'loading'" class="flex flex-col items-center justify-center gap-3 py-16 text-navy-400">
                            <span class="h-9 w-9 animate-spin rounded-full border-2 border-navy-200 border-t-blue-500"></span>
                            <span class="text-sm">{{ __('Loading Google reviews…') }}</span>
                        </div>
                        {{-- live Google reviews (Elfsight) — kept in the DOM so it can populate; hidden only if it stays empty (monthly view cap) --}}
                        <div x-show="state !== 'fallback'" class="elfsight-app-0e0cdec6-2556-432d-a0b1-e2a0934c43a3"></div>
                        {{-- graceful 5-star fallback shown when the reviews widget is capped/unavailable --}}
                        <div x-show="state === 'fallback'" x-cloak class="mx-auto flex max-w-xl flex-col items-center gap-4 rounded-3xl border border-navy-100 bg-gradient-to-b from-navy-50/70 to-white p-10 text-center shadow-sm sm:p-12">
                            <div class="flex items-center gap-1.5 text-3xl text-amber-400" aria-hidden="true">
                                <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                            </div>
                            <div class="font-display text-5xl tracking-wide text-navy-950">{{ __('5.0') }}</div>
                            <p class="max-w-md text-navy-600">{{ __('Our members rate us 5 stars on Google.') }}</p>
                            <a href="https://www.google.com/maps/search/?api=1&amp;query=Pugilist+Club+Ni%C3%A7ois+Nice" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-blue-500">
                                {{ __('Read our Google reviews') }}
                            </a>
                        </div>
                    </div>
                </template>
                <template x-if="! $store.consent.accepted()">
                    <div class="flex flex-col items-center justify-center gap-4 rounded-3xl border border-navy-200 bg-navy-50/60 p-12 text-center">
                        <span class="text-3xl">&#11088;</span>
                        <p class="max-w-sm text-sm text-navy-500">{{ __('Accept cookies to display our Google reviews.') }}</p>
                        <button @click="$store.consent.set('accepted')" class="rounded-full bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-500">{{ __('Accept') }}</button>
                    </div>
                </template>
            </div>
        </section>

        {{-- ============================= LOCATION / MAP ============================= --}}
        <section id="location" class="scroll-mt-24 bg-navy-950 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mx-auto max-w-2xl text-center">
                    <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-400">{{ __('VISIT THE CLUB') }}</span>
                    <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">{{ __('FIND YOUR WAY TO THE RING') }}</h2>
                </div>

                <div class="relative mt-16 grid grid-cols-1 gap-0 overflow-hidden rounded-3xl shadow-2xl lg:grid-cols-5">
                    <div data-reveal="left" class="relative z-10 col-span-2 flex flex-col justify-center gap-8 bg-navy-900 p-10 lg:p-12">
                        <div>
                            <h3 class="font-display text-2xl tracking-wide text-white">PUGILIST CLUB NIÇOIS</h3>
                            <p class="mt-2 text-sm text-white/50">Quartier Libération &middot; Nice, France</p>
                        </div>

                        @foreach ([
                            ['icon' => 'pin', 'label' => 'Address', 'value' => '16 rue Fornéro Méneï, 06300 Nice'],
                            ['icon' => 'phone', 'label' => 'Phone', 'value' => '06 58 97 80 75'],
                            ['icon' => 'clock', 'label' => 'Hours', 'value' => 'Mon-Fri · 5pm-8pm'],
                        ] as $item)
                            <div class="flex items-start gap-4">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600/15 text-blue-400">
                                    @switch($item['icon'])
                                        @case('pin')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M12 21s-7-6.1-7-11a7 7 0 1114 0c0 4.9-7 11-7 11z" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.8"/></svg>
                                            @break
                                        @case('phone')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M4 5c0 8.3 6.7 15 15 15l3-4-6-3-2 2c-2.5-1.2-4.8-3.5-6-6l2-2-3-6z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                                            @break
                                        @case('mail')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="1.8"/></svg>
                                            @break
                                        @default
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                                    @endswitch
                                </span>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wide text-white/40">{{ __($item['label']) }}</p>
                                    <p class="mt-0.5 text-sm font-semibold text-white">{{ __($item['value']) }}</p>
                                </div>
                            </div>
                        @endforeach

                        <a href="https://maps.google.com/?q=Pugilist+Club+Nicois,+16+rue+Forn%C3%A9ro+M%C3%A9ne%C3%AF,+06300+Nice" target="_blank" rel="noopener" class="mt-2 inline-flex w-fit items-center gap-2 rounded-full bg-blue-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-500">
                            {{ __('Get Directions') }}
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    <div data-reveal="right" x-data class="col-span-3 min-h-[380px] bg-navy-800">
                        <template x-if="$store.consent.accepted()">
                            <iframe
                                title="PCN Boxing Club location map"
                                src="https://maps.google.com/maps?q=Pugilist%20Club%20Nicois%2C%2016%20rue%20Forn%C3%A9ro%20M%C3%A9ne%C3%AF%2C%2006300%20Nice&t=&z=15&output=embed"
                                class="h-full min-h-[380px] w-full grayscale-[0.3] contrast-[1.1]"
                                style="border:0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </template>
                        <template x-if="! $store.consent.accepted()">
                            <div class="flex h-full min-h-[380px] flex-col items-center justify-center gap-4 p-8 text-center">
                                <span class="text-3xl">&#128506;</span>
                                <p class="max-w-xs text-sm text-white/60">{{ __('Accept cookies to display the interactive map.') }}</p>
                                <button @click="$store.consent.set('accepted')" class="rounded-full bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-500">{{ __('Accept') }}</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================= JOIN · COURSES & CONTACT ============================= --}}
        <section id="join" class="scroll-mt-24 relative overflow-hidden bg-navy-950 py-24 sm:py-28">
            <div class="absolute inset-0 opacity-10 [background-image:radial-gradient(circle,_white_1.5px,_transparent_1.5px)] [background-size:22px_22px]"></div>
            <div class="pointer-events-none absolute -right-32 -top-24 h-[36rem] w-[36rem] rounded-full bg-blue-600/20 blur-3xl"></div>

            <div class="relative mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-2 lg:gap-16 lg:px-10">
                {{-- Courses & pricing --}}
                <div data-reveal="left">
                    <span class="text-sm font-bold tracking-[0.3em] text-blue-400">{{ __('COURSES & PRICING') }}</span>

                    <div class="mt-8 space-y-4">
                        <!-- Educative Boxing -->
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 transition hover:border-blue-400/40 hover:bg-white/[0.06]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-block rounded-full bg-blue-500/10 px-3 py-0.5 text-xs font-semibold text-blue-300 border border-blue-400/20 mb-1.5">{{ __('Born 2013 – 2019') }}</span>
                                    <h3 class="font-display text-xl tracking-wide text-white">{{ __('EDUCATIVE BOXING') }}</h3>
                                </div>
                                <div class="shrink-0 text-right">
                                    <span class="font-display text-3xl text-blue-400">200€</span>
                                    <span class="block text-[11px] font-semibold uppercase tracking-wide text-white/40">/ {{ __('year') }}</span>
                                </div>
                            </div>
                            <ul class="mt-3.5 space-y-1.5 border-t border-white/10 pt-3 text-xs text-white/70">
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('2 training sessions / week') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('FFB license & federal insurance included') }}</span></li>
                            </ul>
                        </div>

                        <!-- Cadets / Juniors -->
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 transition hover:border-blue-400/40 hover:bg-white/[0.06]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-block rounded-full bg-blue-500/10 px-3 py-0.5 text-xs font-semibold text-blue-300 border border-blue-400/20 mb-1.5">{{ __('Born 2009 – 2012') }}</span>
                                    <h3 class="font-display text-xl tracking-wide text-white">{{ __('CADETS / JUNIORS') }}</h3>
                                </div>
                                <div class="shrink-0 text-right">
                                    <span class="font-display text-3xl text-blue-400">220€</span>
                                    <span class="block text-[11px] font-semibold uppercase tracking-wide text-white/40">/ {{ __('year') }}</span>
                                </div>
                            </div>
                            <ul class="mt-3.5 space-y-1.5 border-t border-white/10 pt-3 text-xs text-white/70">
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('2 training sessions / week') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('FFB license & federal insurance included') }}</span></li>
                            </ul>
                        </div>

                        <!-- Seniors -->
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 transition hover:border-blue-400/40 hover:bg-white/[0.06]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-block rounded-full bg-blue-500/10 px-3 py-0.5 text-xs font-semibold text-blue-300 border border-blue-400/20 mb-1.5">{{ __('Born 2008 & before') }}</span>
                                    <h3 class="font-display text-xl tracking-wide text-white">{{ __('SENIORS') }}</h3>
                                </div>
                                <div class="shrink-0 text-right">
                                    <span class="font-display text-3xl text-blue-400">290€</span>
                                    <span class="block text-[11px] font-semibold uppercase tracking-wide text-white/40">/ {{ __('year') }}</span>
                                </div>
                            </div>
                            <ul class="mt-3.5 space-y-1.5 border-t border-white/10 pt-3 text-xs text-white/70">
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('2 Recreational slots / week') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Heavy bags & strength training 2x / week') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Access to Lady Boxing slot') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Optional sparring sessions') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('FFB license & federal insurance included') }}</span></li>
                            </ul>
                        </div>

                        <!-- Competitor -->
                        <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 transition hover:border-blue-400/40 hover:bg-white/[0.06]">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <span class="inline-block rounded-full bg-blue-500/10 px-3 py-0.5 text-xs font-semibold text-blue-300 border border-blue-400/20 mb-1.5">{{ __('By selection of PCN President') }}</span>
                                    <h3 class="font-display text-xl tracking-wide text-white">{{ __('COMPETITOR') }}</h3>
                                </div>
                                <div class="shrink-0 text-right">
                                    <span class="font-display text-3xl text-blue-400">200€</span>
                                    <span class="block text-[11px] font-semibold uppercase tracking-wide text-white/40">/ {{ __('year') }}</span>
                                </div>
                            </div>
                            <ul class="mt-3.5 space-y-1.5 border-t border-white/10 pt-3 text-xs text-white/70">
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Access to all training sessions') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Physical & technical competition prep') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Dedicated coaching & follow-up') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('Contact us for an interview') }}</span></li>
                                <li class="flex items-center gap-2"><span class="text-blue-400 font-bold text-sm">✓</span> <span>{{ __('FFB license & federal insurance included') }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <p class="mt-5 text-xs text-white/40">* {{ __('Indicative pricing - contact us for full details and required certificates.') }}</p>
                </div>

                {{-- Contact form → POSTs JSON { name, email, phone, course, message } to the
                     PCN Cloudflare Worker (config/pcn.php → contact_endpoint) which emails it via Resend --}}
                <div data-reveal="right" class="self-start rounded-3xl bg-white p-8 shadow-2xl sm:p-10"
                     x-data="contactForm(@js(config('pcn.contact_endpoint')), @js(__('Something went wrong. Please try again or email us directly.')), @js(__('Please complete the security check.')), @js((bool) config('pcn.turnstile_site_key')))">
                    <h3 class="font-display text-2xl tracking-wide text-navy-950">{{ __('SEND US A MESSAGE') }}</h3>
                    <p class="mt-2 text-sm text-navy-600">{{ __('A question or want to sign up? Drop us a line.') }}</p>

                    {{-- Success state --}}
                    <div x-show="sent" x-cloak class="mt-8 flex flex-col items-center gap-4 rounded-2xl border border-blue-100 bg-blue-50/60 p-8 text-center sm:p-10">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <p class="max-w-sm text-sm font-medium text-navy-700">{{ __("Thanks! Your message has been sent - we'll get back to you soon.") }}</p>
                    </div>

                    {{-- Form --}}
                    <form x-show="! sent" @submit.prevent="submit" class="mt-8 space-y-5">
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <label class="block">
                                <span class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Name') }} *</span>
                                <input x-model="form.name" type="text" required autocomplete="name" placeholder="{{ __('Your name') }}"
                                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                            </label>
                            <label class="block">
                                <span class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Email') }} *</span>
                                <input x-model="form.email" type="email" required autocomplete="email" placeholder="{{ __('Your email') }}"
                                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                            </label>
                        </div>

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <label class="block">
                                <span class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Phone (optional)') }}</span>
                                <input x-model="form.phone" type="tel" autocomplete="tel" placeholder="06 12 34 56 78"
                                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                            </label>
                            <label class="block">
                                <span class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Course of interest') }}</span>
                                <select x-model="form.course"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                    <option value="">{{ __('Choose') }}…</option>
                                    <option value="{{ __('Educational Boxing') }}">{{ __('Educational Boxing') }}</option>
                                    <option value="{{ __('Cadets / Juniors') }}">{{ __('Cadets / Juniors') }}</option>
                                    <option value="{{ __('Seniors') }}">{{ __('Seniors') }}</option>
                                    <option value="{{ __('Competition Squad') }}">{{ __('Competition Squad') }}</option>
                                    <option value="{{ __('Other') }}">{{ __('Other') }}</option>
                                </select>
                            </label>
                        </div>

                        <label class="block">
                            <span class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-slate-500">{{ __('Message') }} *</span>
                            <textarea x-model="form.message" required rows="4" placeholder="{{ __("Tell us what you're looking for…") }}"
                                      class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"></textarea>
                        </label>

                        {{-- Cloudflare Turnstile widget (renders only when a Site Key is configured) --}}
                        @if (config('pcn.turnstile_site_key'))
                            <div class="cf-turnstile" data-sitekey="{{ config('pcn.turnstile_site_key') }}" data-callback="onTurnstileCallback"></div>
                        @endif

                        {{-- Error message --}}
                        <p x-show="error" x-cloak x-text="error" class="text-sm font-medium text-red-600"></p>

                        <button type="submit" :disabled="sending"
                                class="inline-flex w-full items-center justify-center gap-2.5 rounded-full bg-blue-600 px-9 py-4 text-sm font-bold tracking-wide text-white shadow-glow transition hover:-translate-y-0.5 hover:bg-blue-500 disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:translate-y-0">
                            <svg x-show="! sending" class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M4 12l16-8-6 16-3-6-7-2z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span x-text="sending ? @js(__('Sending…')) : @js(__('Send Message'))"></span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        {{-- ============================= FOOTER ============================= --}}
        <footer class="relative bg-navy-950 pt-20 pb-8">
            <div class="pointer-events-none absolute inset-x-0 top-0 flex justify-center px-4">
                <span class="h-[3px] w-full max-w-7xl rounded-full bg-gradient-to-r from-transparent via-blue-500 to-transparent"></span>
            </div>

            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-4 lg:px-10">
                <div>
                    <x-logo />
                    <p class="mt-5 max-w-xs text-sm text-white/50">{{ __('A boxing club built on discipline, respect and real coaching - from your first jab to your first fight.') }}</p>
                    <div class="mt-6 flex gap-3">
                        @foreach (['instagram', 'facebook', 'youtube'] as $social)
                            <a href="#" class="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition hover:border-blue-400 hover:text-blue-400">
                                @if ($social === 'instagram')
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>
                                @elseif ($social === 'facebook')
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M14 9h3V6h-3c-2 0-3.5 1.5-3.5 3.5V12H8v3h2.5v6h3v-6H16l.5-3h-3v-1.5c0-.6.4-1.5 1.5-1.5z" fill="currentColor"/></svg>
                                @else
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><rect x="3" y="6" width="18" height="12" rx="3" stroke="currentColor" stroke-width="1.8"/><path d="M10 9.5l5 2.5-5 2.5z" fill="currentColor"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wide text-white">{{ __('Quick Links') }}</h4>
                    <ul class="mt-5 space-y-3 text-sm text-white/50">
                        <li><a href="#about" class="transition hover:text-blue-400">{{ __('About') }}</a></li>
                        <li><a href="/horaires" class="transition hover:text-blue-400">{{ __('Schedule') }}</a></li>
                        <li><a href="/galerie" class="transition hover:text-blue-400">{{ __('Gallery') }}</a></li>
                        <li><a href="#testimonials" class="transition hover:text-blue-400">{{ __('Fighters Say') }}</a></li>
                        <li><a href="#location" class="transition hover:text-blue-400">{{ __('Location') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wide text-white">{{ __('Programs') }}</h4>
                    <ul class="mt-5 space-y-3 text-sm text-white/50">
                        <li>{{ __('Youth Boxing') }}</li>
                        <li>{{ __('Fitness Boxing') }}</li>
                        <li>{{ __('Competitive Team') }}</li>
                        <li>{{ __('1-on-1 Coaching') }}</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wide text-white">{{ __('Stay Sharp') }}</h4>
                    <p class="mt-5 text-sm text-white/50">{{ __('Get schedule updates and fight-night announcements.') }}</p>
                    <form class="mt-4 flex gap-2" onsubmit="return false">
                        <input type="email" placeholder="{{ __('Your email') }}" class="w-full min-w-0 rounded-full border border-white/15 bg-white/5 px-4 py-2.5 text-sm text-white placeholder-white/30 focus:border-blue-400 focus:outline-none" />
                        <button class="shrink-0 rounded-full bg-blue-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-blue-500">OK</button>
                    </form>
                </div>
            </div>

            <div x-data class="mx-auto mt-14 max-w-7xl border-t border-white/10 px-6 pt-6 text-center text-xs text-white/40 lg:px-10">
                &copy; {{ date('Y') }} Pugilist Club Niçois. {{ __('All rights reserved.') }}
                <span class="mx-2 text-white/20">&middot;</span>
                Conçu &amp; développé par Luka Tsurtsumia
                <span class="mx-2 text-white/20">&middot;</span>
                <button @click="$store.consent.reopen()" class="underline underline-offset-2 transition hover:text-white/70">🍪 {{ __('Cookie settings') }}</button>
            </div>
        </footer>

        {{-- ============================= COOKIE BANNER ============================= --}}
        <div
            x-data
            x-show="! $store.consent.decided()"
            x-cloak
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="fixed inset-x-0 bottom-0 z-[60] p-4 sm:p-6"
        >
            <div class="mx-auto flex max-w-4xl flex-col gap-4 rounded-2xl border border-white/10 bg-navy-900/95 p-5 shadow-2xl shadow-black/40 backdrop-blur-md sm:flex-row sm:items-center sm:gap-6 sm:p-6">
                <p class="flex-1 text-sm leading-relaxed text-white/70">
                    <span class="mr-1.5">🍪</span>{{ __('We use cookies to improve your experience and to display the map and reviews. You can accept or refuse.') }}
                </p>
                <div class="flex shrink-0 gap-3">
                    <button @click="$store.consent.set('refused')" class="rounded-full border border-white/25 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-white/10">{{ __('Refuse') }}</button>
                    <button @click="$store.consent.set('accepted')" class="rounded-full bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Accept') }}</button>
                </div>
            </div>
        </div>
    </body>
</html>
