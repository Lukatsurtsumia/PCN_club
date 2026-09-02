@extends('layouts.page')

@section('title', __('Schedule'))

@section('content')
<section class="relative overflow-hidden bg-navy-950 py-20 sm:py-28">
    {{-- Ambient light effect --}}
    <div class="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 h-[32rem] w-[50rem] rounded-full bg-blue-600/15 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 lg:px-10">

        <!-- Header -->
        <div class="mx-auto max-w-3xl text-center">
            <span class="text-sm font-bold tracking-[0.3em] uppercase text-blue-400">
                {{ __('WEEKLY SCHEDULE') }}
            </span>

            <h1 class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">
                {{ __('FIND YOUR SLOT') }}
            </h1>

            <p class="mt-5 text-lg leading-8 text-white/60">
                {{ __('All sessions are coached. Times may vary during holidays - contact us to confirm.') }}
            </p>
        </div>

        <!-- Schedule Image Card -->
        <div class="mt-12 flex justify-center">
            <div class="group relative w-full max-w-5xl overflow-hidden rounded-3xl border border-white/10 bg-navy-900/80 p-2 shadow-2xl backdrop-blur ring-1 ring-white/10 sm:p-4 transition duration-300 hover:border-blue-500/30">
                <a href="/documents/pcn-horaires-sept-2026.jpeg" target="_blank" rel="noopener noreferrer" class="block overflow-hidden rounded-2xl cursor-zoom-in" title="{{ __('Click to enlarge') }}">
                    <img
                        src="/documents/pcn-horaires-sept-2026.jpeg"
                        alt="Planning Hebdomadaire - Pugilist Club Niçois"
                        class="w-full h-auto rounded-2xl object-contain transition duration-500 group-hover:scale-[1.01]"
                        loading="eager"
                    />
                </a>

                {{-- Action Bar under image --}}
                <div class="mt-4 flex flex-wrap items-center justify-between gap-3 px-3 py-2 text-xs font-semibold text-white/60">
                    <span class="inline-flex items-center gap-2">
                        <span class="inline-block h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ __('Season 2026 / 2027') }}
                    </span>
                    <div class="flex items-center gap-3">
                        <a href="/documents/pcn-horaires-sept-2026.jpeg" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-1.5 text-white transition hover:bg-white/20">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6" />
                                <polyline points="15 3 21 3 21 9" />
                                <line x1="10" y1="14" x2="21" y2="3" />
                            </svg>
                            {{ __('Open full size') }}
                        </a>
                        <a href="/documents/pcn-horaires-sept-2026.jpeg" download="pcn-horaires-2026-2027.jpeg" class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600/80 px-3 py-1.5 text-white transition hover:bg-blue-600">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" y1="15" x2="12" y2="3" />
                            </svg>
                            {{ __('Download') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-16 text-center">
            <a href="/#join"
               class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition duration-300 hover:-translate-y-1 hover:bg-blue-500">
                {{ __('Join The Club') }}
            </a>
        </div>

    </div>
</section>
@endsection
