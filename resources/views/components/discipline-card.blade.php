@props(['title', 'img'])

{{-- Click-to-flip discipline card: photo on the front, description ($slot) on the back --}}
<div x-data="{ f: false }" @click="f = !f" @keydown.enter="f = !f" @keydown.space.prevent="f = !f"
     :class="f && 'is-flipped'" role="button" tabindex="0"
     class="flip-card h-[32rem] lg:h-[28rem] cursor-pointer rounded-3xl focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400 focus-visible:ring-offset-2 focus-visible:ring-offset-navy-950">
    <div class="flip-card-inner">
        {{-- front: photo + title --}}
        <div class="flip-face overflow-hidden rounded-3xl shadow-xl ring-1 ring-white/10">
            <img src="/images/{{ $img }}.jpg" alt="{{ $title }}" loading="lazy" class="absolute inset-0 h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/45 to-navy-950/5"></div>
            <div class="absolute inset-0 flex flex-col justify-end p-7">
                <h3 class="font-display text-3xl tracking-wide text-white sm:text-4xl">{{ mb_strtoupper($title, 'UTF-8') }}</h3>
                <span class="mt-3 inline-flex items-center gap-2 text-sm font-bold text-blue-300">
                    {{ __('Click to discover') }}
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"><path d="M4 12a8 8 0 108-8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M12 4l-3 3m3-3l3 3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
        </div>
        {{-- back: description --}}
        <div class="flip-face flip-face-back flex flex-col overflow-hidden rounded-3xl bg-navy-900 p-7 shadow-xl ring-1 ring-white/10 sm:p-8">
            <h3 class="font-display text-2xl tracking-wide text-white">{{ $title }}</h3>
            <span class="mt-3 h-[3px] w-11 rounded-full bg-blue-500"></span>
            <p class="mt-4 flex-1 overflow-y-auto pr-1 text-sm leading-relaxed text-white/70">{{ $slot }}</p>
            <span class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wide text-blue-400">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"><path d="M9 14l-4-4 4-4m-4 4h11a4 4 0 010 8h-1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ __('Click to flip back') }}
            </span>
        </div>
    </div>
</div>
