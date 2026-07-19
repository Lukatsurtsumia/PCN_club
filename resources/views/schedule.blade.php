@extends('layouts.page')

@section('title', __('Schedule'))

@section('content')
    <section class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-bold tracking-[0.3em] text-blue-600">{{ __('WEEKLY SCHEDULE') }}</span>
                <h1 class="mt-4 font-display text-4xl tracking-wide text-navy-950 sm:text-5xl">{{ __('FIND YOUR SLOT') }}</h1>
                <p class="mt-5 text-lg text-navy-500">{{ __('All sessions are coached. Times may vary during holidays - contact us to confirm.') }}</p>
            </div>

            @php
                $classColor = [
                    'Youth Boxing'     => ['dot' => 'bg-blue-500',   'bar' => 'border-blue-500'],
                    'Fitness Boxing'   => ['dot' => 'bg-sky-400',    'bar' => 'border-sky-400'],
                    'Competitive Team' => ['dot' => 'bg-rose-500',   'bar' => 'border-rose-500'],
                    '1-on-1 Coaching'  => ['dot' => 'bg-violet-500', 'bar' => 'border-violet-500'],
                    'Sparring'         => ['dot' => 'bg-amber-500',  'bar' => 'border-amber-500'],
                    'Open Sparring'    => ['dot' => 'bg-amber-500',  'bar' => 'border-amber-500'],
                ];
                $week = [
                    'Monday'    => [['17h00','Youth Boxing'],['18h30','Fitness Boxing'],['20h00','Competitive Team']],
                    'Tuesday'   => [['18h00','Fitness Boxing'],['19h30','1-on-1 Coaching']],
                    'Wednesday' => [['14h00','Youth Boxing'],['18h30','Fitness Boxing'],['20h00','Sparring']],
                    'Thursday'  => [['18h00','Fitness Boxing'],['19h30','Competitive Team']],
                    'Friday'    => [['17h00','Youth Boxing'],['18h30','Fitness Boxing'],['20h00','1-on-1 Coaching']],
                    'Saturday'  => [['10h00','Fitness Boxing'],['11h30','Open Sparring']],
                ];
            @endphp

            {{-- colour legend --}}
            <div class="mt-10 flex flex-wrap items-center justify-center gap-x-6 gap-y-3">
                @foreach ($classColor as $cls => $c)
                    @continue($cls === 'Open Sparring')
                    <span class="inline-flex items-center gap-2 text-xs font-semibold text-navy-600">
                        <span class="h-2.5 w-2.5 rounded-full {{ $c['dot'] }}"></span>{{ __($cls) }}
                    </span>
                @endforeach
            </div>

            <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                @foreach ($week as $day => $slots)
                    <div class="overflow-hidden rounded-2xl border border-navy-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <h3 class="bg-navy-950 py-3.5 text-center font-display text-base tracking-[0.15em] text-white">{{ mb_strtoupper(__($day), 'UTF-8') }}</h3>
                        <ul class="flex flex-col gap-2.5 p-4">
                            @foreach ($slots as $slot)
                                <li class="rounded-lg border-l-4 {{ $classColor[$slot[1]]['bar'] }} bg-navy-50/70 py-2.5 pl-3 pr-2 transition hover:bg-navy-100/70">
                                    <span class="block text-[15px] font-bold leading-tight text-navy-900">{{ $slot[0] }}</span>
                                    <span class="mt-0.5 block text-xs font-medium text-navy-500">{{ __($slot[1]) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="mt-14 text-center">
                <a href="/#join" class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
            </div>
        </div>
    </section>
@endsection
