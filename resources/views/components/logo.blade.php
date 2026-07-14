@props(['ring' => 'blue-500'])

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
    <img src="/images/pcn-logo.jpg" alt="PCN - Pugilist Club Niçois" class="h-11 w-11 shrink-0 rounded-xl bg-white object-contain p-0.5 shadow-sm sm:h-12 sm:w-12" />
    <span class="leading-none">
        <span class="block font-display text-xl sm:text-2xl tracking-wide text-white">PCN</span>
        <span class="block text-[10px] sm:text-[11px] font-semibold tracking-[0.35em] text-blue-300">BOXING CLUB</span>
    </span>
</div>
