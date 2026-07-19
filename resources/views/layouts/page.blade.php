<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') | Pugilist Club Niçois</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body bg-navy-950 text-white antialiased">
        <header class="sticky top-0 z-50 border-b border-white/10 bg-navy-950/90 backdrop-blur-md">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-10">
                <a href="/" class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white p-1">
                        <img src="/images/pcn-logo.jpg" alt="PCN" class="h-full w-full object-contain" />
                    </span>
                    <span class="font-display text-lg tracking-wide text-white">PCN <span class="text-blue-500">BOXING</span></span>
                </a>
                <div class="flex items-center gap-5 text-sm font-semibold">
                    <a href="/" class="text-white/70 transition hover:text-white">&larr; {{ __('Home') }}</a>
                    <span class="flex items-center gap-1.5 text-xs font-bold">
                        <a href="/lang/fr" class="{{ app()->getLocale() === 'fr' ? 'text-blue-400' : 'text-white/50 hover:text-white' }}">FR</a>
                        <span class="text-white/25">/</span>
                        <a href="/lang/en" class="{{ app()->getLocale() === 'en' ? 'text-blue-400' : 'text-white/50 hover:text-white' }}">EN</a>
                    </span>
                </div>
            </div>
        </header>

        <main class="min-h-[70vh]">
            @yield('content')
        </main>

        <footer class="border-t border-white/10 bg-navy-950 py-8 text-center text-xs text-white/40">
            &copy; {{ date('Y') }} Pugilist Club Niçois. {{ __('All rights reserved.') }}
            <span class="mx-2 text-white/20">&middot;</span>
            Conçu &amp; développé par Luka Tsurtsumia
        </footer>
    </body>
</html>
