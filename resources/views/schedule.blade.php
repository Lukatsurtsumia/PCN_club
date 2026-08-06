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
 <h1>Schedule for a 26/27 season are comming soon </h1>
            <div class="mt-14 text-center">
                <a href="/#join" class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition hover:bg-blue-500 hover:-translate-y-0.5">{{ __('Join The Club') }}</a>
            </div>
        </div>
    </section>
@endsection
