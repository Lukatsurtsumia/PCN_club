@extends('layouts.page')

@section('title', __('Gallery'))

@section('content')
    <section class="bg-navy-950 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-bold tracking-[0.3em] text-blue-400">{{ __('GALLERY') }}</span>
                <h1 class="mt-4 font-display text-4xl tracking-wide text-white sm:text-5xl">{{ __('INSIDE THE GYM') }}</h1>
                <p class="mt-5 text-lg text-white/50">{{ __('Real training, real fighters, real community.') }}</p>
            </div>

            @php
                $gallery = [
                    ['img' => 'prog-team.jpg',     'span' => 'sm:col-span-2 sm:row-span-2'],
                    ['img' => 'gallery-2.jpg',     'span' => ''],
                    ['img' => 'gallery-3.jpg',     'span' => ''],
                    ['img' => 'prog-fitness.jpg',  'span' => ''],
                    ['img' => 'gallery-1.jpg',     'span' => 'sm:row-span-2'],
                    ['img' => 'gallery-4.jpg',     'span' => ''],
                    ['img' => 'prog-youth.jpg',    'span' => ''],
                    ['img' => 'gallery-6.jpg',     'span' => ''],
                    ['img' => 'prog-coaching.jpg', 'span' => ''],
                    ['img' => 'gallery-5.jpg',     'span' => ''],
                ];
            @endphp

            <div class="mt-16 grid grid-flow-dense auto-rows-[170px] grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 lg:grid-cols-4">
                @foreach ($gallery as $g)
                    <div class="group relative overflow-hidden rounded-2xl bg-navy-900 {{ $g['span'] }}">
                        <img src="/images/{{ $g['img'] }}" alt="Pugilist Club Niçois" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" />
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-navy-950/70 via-transparent to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
