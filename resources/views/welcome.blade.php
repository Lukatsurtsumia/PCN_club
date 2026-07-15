<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Pugilist Club Niçois - club de boxe anglaise à Nice depuis 1969. Boxe jeunesse, fitness, compétition et coaching privé.">

        <title>Pugilist Club Niçois | Boxe Anglaise à Nice</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        {{-- start the CDN connections early: 3D library + reviews widget --}}
        <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
        <link rel="dns-prefetch" href="https://elfsightcdn.com">
        <link rel="dns-prefetch" href="https://static.elfsight.com">
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        {{-- three.js for the 3D boxer (must come before any module script) --}}
        <script type="importmap">
        {
          "imports": {
            "three": "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/"
          }
        }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                <nav class="hidden items-center gap-9 lg:flex">
                    <a href="#about" class="text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('About') }}</a>
                    <a href="#programs" class="text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Programs') }}</a>
                    <a href="#testimonials" class="text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Fighters Say') }}</a>
                    <a href="#location" class="text-sm font-semibold tracking-wide text-white/80 transition hover:text-white">{{ __('Location') }}</a>
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
                    <a @click="close()" href="#programs" class="text-base font-semibold text-white/90">{{ __('Programs') }}</a>
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

            {{-- ===== 3D animated boxer (persistent across all hero slides) ===== --}}
            {{-- spotlight glow behind the fighter --}}
            <div class="pointer-events-none absolute -bottom-10 right-0 z-0 h-[85%] w-[75%] max-w-[760px] bg-[radial-gradient(ellipse_at_bottom_right,_rgba(37,99,235,0.38),_transparent_62%)]"></div>
            {{-- 3D animated boxer --}}
            <div data-boxer-3d data-model="/models/hero-boxer.fbx" data-recolor="1" class="pointer-events-none absolute bottom-0 right-0 z-[1] h-[62%] w-full opacity-90 sm:h-[85%] sm:w-[75%] sm:opacity-100 md:h-full md:w-[62%] md:max-w-[760px] lg:right-[3%]"></div>
            {{-- readability scrim so the headline stays crisp over the fighter --}}
            <div class="pointer-events-none absolute inset-0 z-[5] bg-gradient-to-r from-navy-950 via-navy-950/70 to-transparent sm:from-navy-950/95 sm:via-navy-950/35"></div>
            {{-- bottom fade to ground him --}}
            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[5] h-40 bg-gradient-to-t from-navy-950 via-navy-950/60 to-transparent"></div>
            {{-- ===== shared 3D boxer loader: powers the hero + all program cards, lazy per viewport ===== --}}
            <script type="module">
                import * as THREE from 'three';
                import { FBXLoader } from 'three/addons/loaders/FBXLoader.js';

                function initBoxer(mount) {
                    let started = false, visible = true, mixer, renderer, scene, camera, boxCenter, boxSize;
                    const clock = new THREE.Clock();

                    function build() {
                        if (started) return; started = true;
                        const w = Math.max(mount.clientWidth, 1), h = Math.max(mount.clientHeight, 1);
                        scene = new THREE.Scene();
                        camera = new THREE.PerspectiveCamera(40, w / h, 1, 6000);
                        renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
                        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.75));
                        renderer.setSize(w, h);
                        renderer.outputColorSpace = THREE.SRGBColorSpace;
                        mount.appendChild(renderer.domElement);

                        scene.add(new THREE.HemisphereLight(0xffffff, 0x22314a, 2.0));
                        const key = new THREE.DirectionalLight(0xffffff, 2.4); key.position.set(120, 240, 180); scene.add(key);
                        const rim = new THREE.DirectionalLight(0x6aa8ff, 1.4); rim.position.set(-160, 120, -140); scene.add(rim);

                        // (re)frame the whole figure for the container's current size - called on load and on any resize
                        function frame() {
                            if (!boxSize || !renderer) return;
                            const cw = Math.max(mount.clientWidth, 1), ch = Math.max(mount.clientHeight, 1);
                            const aspect = cw / ch;
                            const vfov = camera.fov * Math.PI / 180;
                            const distH = (boxSize.y / 2) / Math.tan(vfov / 2);
                            const distW = (boxSize.x / 2) / (Math.tan(vfov / 2) * aspect);
                            const dist = Math.max(distH, distW) * 1.35;
                            const ty = boxCenter.y + boxSize.y * 0.08; // aim slightly high: head clears nav, feet stay in frame
                            camera.aspect = aspect;
                            camera.near = dist / 100;
                            camera.far = dist * 100;
                            camera.updateProjectionMatrix();
                            camera.position.set(boxCenter.x, ty, boxCenter.z + dist);
                            camera.lookAt(boxCenter.x, ty, boxCenter.z);
                            renderer.setSize(cw, ch);
                        }
                        new ResizeObserver(frame).observe(mount);

                        new FBXLoader().load(mount.dataset.model, (obj) => {
                            if (mount.dataset.recolor) {
                                obj.traverse((o) => {
                                    if (o.isMesh && o.material) {
                                        const mats = Array.isArray(o.material) ? o.material : [o.material];
                                        mats.forEach((mt) => {
                                            if (mt.color) mt.color.set(0xa9c8ff);
                                            if ('emissive' in mt) mt.emissive.set(0x22367a);
                                            if ('shininess' in mt) mt.shininess = 30;
                                            mt.needsUpdate = true;
                                        });
                                    }
                                });
                            }
                            scene.add(obj);
                            const bindBox = new THREE.Box3().setFromObject(obj);
                            const bindC = bindBox.getCenter(new THREE.Vector3());
                            const bindS = bindBox.getSize(new THREE.Vector3());

                            if (obj.animations.length) {
                                // some Mixamo exports include an empty "Take 001" clip first,
                                // so pick the clip with the most tracks (the real animation)
                                const clip = obj.animations.reduce((a, b) => (b.tracks.length > a.tracks.length ? b : a));
                                mixer = new THREE.AnimationMixer(obj);
                                mixer.clipAction(clip).play();
                                // the animated pose can sit higher/taller than the bind box (skinning isn't
                                // reflected in it), so measure the true vertical extent from the skeleton
                                let minY = Infinity, maxY = -Infinity; const p = new THREE.Vector3();
                                for (let i = 0; i <= 5; i++) {
                                    mixer.setTime(clip.duration * i / 5); obj.updateMatrixWorld(true);
                                    obj.traverse((n) => { if (n.isBone) { n.getWorldPosition(p); if (p.y < minY) minY = p.y; if (p.y > maxY) maxY = p.y; } });
                                }
                                mixer.setTime(0);
                                const ext = maxY - minY;
                                const top = maxY + ext * 0.12, bottom = minY - ext * 0.05; // pad for skull above head-bone and boot below ankle
                                boxCenter = new THREE.Vector3(bindC.x, (top + bottom) / 2, bindC.z);
                                boxSize = new THREE.Vector3(bindS.x, top - bottom, bindS.z);
                            } else {
                                boxCenter = bindC; boxSize = bindS;
                            }
                            frame();
                        });

                        window.addEventListener('orientationchange', () => setTimeout(frame, 300));

                        (function tick() {
                            requestAnimationFrame(tick);
                            if (!visible || !renderer) return;
                            if (mixer) mixer.update(clock.getDelta());
                            renderer.render(scene, camera);
                        })();
                    }

                    // IntersectionObserver is a perf optimization (pause offscreen). Not all
                    // environments fire it, so we also build on a short fallback timer.
                    try {
                        new IntersectionObserver((entries) => {
                            entries.forEach((e) => { visible = e.isIntersecting; if (visible) build(); });
                        }, { rootMargin: '250px' }).observe(mount);
                    } catch (e) { /* no IO support */ }
                    setTimeout(build, 300);
                }

                document.querySelectorAll('[data-boxer-3d]').forEach(initBoxer);
            </script>

            {{-- content --}}
            <div class="relative z-10 mx-auto flex h-full max-w-7xl items-center px-6 lg:px-10">
                <template x-if="active === 0">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('PCN BOXING CLUB') }}</span>
                        <h1 class="font-display text-5xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-6xl lg:text-7xl">{{ __('TRAIN LIKE A') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('CHAMPION') }}</span></h1>
                        <p class="mt-6 max-w-lg text-lg text-white/70">{{ __('Elite coaching, real ring craft, and a corner that pushes you every single round. This is where fighters are made.') }}</p>
                        <div class="mt-9 flex flex-wrap gap-4">
                            <a href="#join" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
                            <a href="#programs" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold tracking-wide text-white transition hover:border-white hover:bg-white/10">{{ __('View Programs') }}</a>
                        </div>
                    </div>
                </template>

                <template x-if="active === 1">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('EVERY ROUND COUNTS') }}</span>
                        <h1 class="font-display text-5xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-6xl lg:text-7xl">{{ __('DISCIPLINE.') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('POWER.') }}</span> {{ __('PRECISION.') }}</h1>
                        <p class="mt-6 max-w-lg text-lg text-white/70">{{ __('From your first jab to your first fight night, our coaches build technique that lasts - not just a good workout.') }}</p>
                        <div class="mt-9 flex flex-wrap gap-4">
                            <a href="#join" class="rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
                            <a href="#about" class="rounded-full border border-white/30 px-8 py-3.5 text-sm font-bold tracking-wide text-white transition hover:border-white hover:bg-white/10">{{ __('Our Story') }}</a>
                        </div>
                    </div>
                </template>

                <template x-if="active === 2">
                    <div class="animate-hero-in max-w-xl">
                        <span class="mb-5 inline-block rounded-full border border-blue-400/40 bg-blue-500/10 px-4 py-1.5 text-xs font-bold tracking-[0.3em] text-blue-300 backdrop-blur-sm">{{ __('ONE TEAM. ONE CORNER.') }}</span>
                        <h1 class="font-display text-5xl leading-[0.95] tracking-wide text-white [text-shadow:0_4px_28px_rgba(0,0,0,0.65)] sm:text-6xl lg:text-7xl">{{ __('JOIN THE') }} <span class="text-blue-500 [text-shadow:0_0_24px_rgba(59,130,246,0.7)]">{{ __('PCN') }}</span> {{ __('FAMILY') }}</h1>
                        <p class="mt-6 max-w-lg text-lg text-white/70">{{ __('A gym built on respect, sweat, and community. All levels welcome - no experience needed to start.') }}</p>
                        <div class="mt-9 flex flex-wrap gap-4">
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
                    <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl leading-tight tracking-wide text-navy-950 sm:text-5xl">{{ __('MORE THAN A GYM.') }} <br class="hidden sm:block" />{{ __("IT'S A CORNER FOR LIFE.") }}</h2>
                    <p data-reveal="up" data-reveal-delay="2" class="mt-6 max-w-xl text-lg text-navy-700/80">
                        {{ __("PCN Boxing Club was founded on one idea: real technique, honest coaching, and a community that has your back between rounds. Whether you're stepping into a gym for the first time or chasing a title, our coaches meet you where you are and push you past it.") }}
                    </p>

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

                    <div class="mt-12 grid max-w-lg grid-cols-3 gap-6 border-t border-navy-100 pt-8">
                        @foreach ([
                            ['target' => 50, 'suffix' => '+', 'label' => 'Years'],
                            ['target' => 1500, 'suffix' => '+', 'label' => 'Members Trained'],
                            ['target' => 15, 'suffix' => '+', 'label' => 'Classes / Month'],
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

        {{-- ============================= PROGRAMS (animated boxer cards) ============================= --}}
        <section id="programs" class="scroll-mt-24 bg-navy-950 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-10">
                <div class="mx-auto max-w-2xl text-center">
                    <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-400">{{ __('TRAINING PROGRAMS') }}</span>
                    <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">{{ __('FIND YOUR ROUND') }}</h2>
                    <p data-reveal="up" data-reveal-delay="2" class="mt-5 text-lg text-white/60">{{ __('Four paths. One gym. Every session is coached, structured, and built around real boxing fundamentals.') }}</p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([
                        ['img' => '/images/prog-youth.jpg', 'title' => 'Youth Boxing', 'desc' => 'Ages 8-16 build footwork, discipline and confidence with age-matched coaching.', 'tag' => 'Ages 8-16'],
                        ['img' => '/images/prog-fitness.jpg', 'title' => 'Fitness Boxing', 'desc' => 'High-energy pad and bag rounds that torch calories and sharpen technique.', 'tag' => 'All Levels'],
                        ['img' => '/images/prog-team.jpg', 'title' => 'Competitive Team', 'desc' => 'Sparring, conditioning and fight-camp prep for our amateur roster.', 'tag' => 'By Trial'],
                        ['img' => '/images/prog-coaching.jpg', 'title' => '1-on-1 Coaching', 'desc' => 'Private sessions dialed into your goals - form, power, or fight prep.', 'tag' => 'Private'],
                    ] as $i => $card)
                        <div data-reveal="up" data-reveal-delay="{{ $i + 1 }}" class="group overflow-hidden rounded-3xl bg-navy-900 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-glow">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $card['img'] }}?v=4" alt="{{ __($card['title']) }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-navy-900/25 to-transparent"></div>
                                <span class="absolute right-4 top-4 rounded-full border border-white/20 bg-navy-950/60 px-3 py-1 text-[10px] font-bold tracking-wider text-white backdrop-blur-sm">{{ __($card['tag']) }}</span>
                            </div>
                            <div class="p-6">
                                <h3 class="font-display text-xl tracking-wide text-white">{{ mb_strtoupper(__($card['title']), 'UTF-8') }}</h3>
                                <p class="mt-3 text-sm text-white/60">{{ __($card['desc']) }}</p>
                                <a href="#join" class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-blue-400 transition group-hover:gap-3">
                                    {{ __('Learn more') }}
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ============================= TESTIMONIALS (auto-scroll) ============================= --}}
        <section id="testimonials" class="scroll-mt-24 bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 text-center lg:px-10">
                <span data-reveal="up" class="text-sm font-bold tracking-[0.3em] text-blue-600">{{ __('FIGHTERS SAY') }}</span>
                <h2 data-reveal="up" data-reveal-delay="1" class="mt-4 font-display text-4xl tracking-wide text-navy-950 sm:text-5xl">{{ __('REAL PEOPLE. REAL RESULTS.') }}</h2>
            </div>

            {{-- Live Google reviews via Elfsight - pulls the club's reviews from Google and auto-updates --}}
            <div data-reveal="up" data-reveal-delay="2" class="mx-auto mt-12 max-w-7xl px-6 lg:px-10">
                <script src="https://elfsightcdn.com/platform.js" async></script>
                <div class="elfsight-app-0e0cdec6-2556-432d-a0b1-e2a0934c43a3" data-elfsight-app-lazy></div>
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
                            ['icon' => 'phone', 'label' => 'Phone', 'value' => '04 93 89 05 09'],
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

                    <div data-reveal="right" class="col-span-3 min-h-[380px] bg-navy-800">
                        <iframe
                            title="PCN Boxing Club location map"
                            src="https://maps.google.com/maps?q=Pugilist%20Club%20Nicois%2C%2016%20rue%20Forn%C3%A9ro%20M%C3%A9ne%C3%AF%2C%2006300%20Nice&t=&z=15&output=embed"
                            class="h-full min-h-[380px] w-full grayscale-[0.3] contrast-[1.1]"
                            style="border:0"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
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
                    <h2 class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">{{ __('JOIN THE CLUB') }}</h2>
                    <p class="mt-5 max-w-md text-lg text-white/60">{{ __('Pick your discipline. Annual membership, coached by our team - license & insurance included.') }}</p>

                    <div class="mt-8 space-y-4">
                        @foreach ([
                            ['name' => 'Boxing · Adults', 'desc' => 'All levels · technique &amp; sparring', 'price' => '250'],
                            ['name' => 'Youth School (8-16)', 'desc' => 'Dedicated junior coaching', 'price' => '200'],
                            ['name' => 'Fit Boxing', 'desc' => 'Cardio · conditioning · pads', 'price' => '220'],
                        ] as $course)
                            <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/[0.04] p-5 transition hover:border-blue-400/40 hover:bg-white/[0.06]">
                                <div>
                                    <h3 class="font-display text-lg tracking-wide text-white">{{ mb_strtoupper(__($course['name']), 'UTF-8') }}</h3>
                                    <p class="mt-1 text-sm text-white/50">{!! __($course['desc']) !!}</p>
                                </div>
                                <div class="shrink-0 text-right">
                                    <span class="font-display text-3xl text-blue-400">{{ $course['price'] }}€</span>
                                    <span class="block text-[11px] font-semibold uppercase tracking-wide text-white/40">/ {{ __('year') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-5 text-xs text-white/40">* {{ __('Indicative pricing - contact us for full details and required certificates.') }}</p>
                </div>

                {{-- Contact form --}}
                <div data-reveal="right" class="rounded-3xl bg-white p-8 shadow-2xl sm:p-10">
                    @if (session('contact_sent'))
                        <div class="mb-6 flex items-center gap-3 rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-700 ring-1 ring-green-200">
                            <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            {{ __("Thanks! Your message has been sent - we'll get back to you soon.") }}
                        </div>
                    @endif

                    <h3 class="font-display text-2xl tracking-wide text-navy-950">{{ __('SEND US A MESSAGE') }}</h3>
                    <p class="mt-2 text-sm text-navy-600">{{ __('A question or want to sign up? Drop us a line.') }}</p>

                    <form method="POST" action="{{ route('contact') }}" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy-500">{{ __('Name') }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="{{ __('Your name') }}" class="w-full rounded-xl border border-navy-200 bg-navy-50/40 px-4 py-3 text-sm text-navy-900 outline-none transition placeholder:text-navy-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20" />
                                @error('name') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy-500">{{ __('Phone') }}</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="06 12 34 56 78" class="w-full rounded-xl border border-navy-200 bg-navy-50/40 px-4 py-3 text-sm text-navy-900 outline-none transition placeholder:text-navy-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20" />
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy-500">{{ __('Email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@email.com" class="w-full rounded-xl border border-navy-200 bg-navy-50/40 px-4 py-3 text-sm text-navy-900 outline-none transition placeholder:text-navy-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20" />
                            @error('email') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy-500">{{ __('Course of interest') }}</label>
                            <select name="course" class="w-full rounded-xl border border-navy-200 bg-navy-50/40 px-4 py-3 text-sm text-navy-900 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20">
                                <option value="">- {{ __('Choose') }} -</option>
                                <option>{{ __('Boxing · Adults') }}</option>
                                <option>{{ __('Youth School (8-16)') }}</option>
                                <option>{{ __('Fit Boxing') }}</option>
                                <option>{{ __('Other') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wide text-navy-500">{{ __('Message') }}</label>
                            <textarea name="message" rows="4" required placeholder="{{ __("Tell us what you're looking for…") }}" class="w-full rounded-xl border border-navy-200 bg-navy-50/40 px-4 py-3 text-sm text-navy-900 outline-none transition placeholder:text-navy-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full rounded-full bg-blue-600 px-8 py-4 text-sm font-bold tracking-wide text-white shadow-glow transition hover:-translate-y-0.5 hover:bg-blue-500">
                            {{ __('Send Message') }}
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
                        <li><a href="#programs" class="transition hover:text-blue-400">{{ __('Programs') }}</a></li>
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

            <div class="mx-auto mt-14 max-w-7xl border-t border-white/10 px-6 pt-6 text-center text-xs text-white/40 lg:px-10">
                &copy; {{ date('Y') }} Pugilist Club Niçois. {{ __('All rights reserved.') }}
            </div>
        </footer>
    </body>
</html>
