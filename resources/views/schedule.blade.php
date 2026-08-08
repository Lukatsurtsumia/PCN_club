@extends('layouts.page')

@section('title', 'Programme')

@section('content')
<section class="bg-white py-20 sm:py-28">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">

        <!-- Header -->
        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-bold tracking-[0.3em] uppercase text-blue-600">
                Programme Hebdomadaire
            </span>

            <h1 class="mt-4 font-display text-4xl tracking-wide text-navy-950 sm:text-5xl">
                Trouvez votre séance d'entraînement
            </h1>

            <p class="mt-6 text-lg leading-8 text-slate-600">
                Entraînez-vous avec des entraîneurs expérimentés dans un environnement
                professionnel et motivant. Que vous soyez débutant ou sportif confirmé,
                nous proposons des séances adaptées à tous les niveaux.
            </p>
        </div>

        <!-- Coming Soon Card -->
        <div class="mt-10 flex justify-center">
            <div class="w-full max-w-3xl rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-blue-100 px-8 py-12 text-center shadow-xl">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-10 w-10"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                    </svg>
                </div>

                <span class="mt-8 inline-flex rounded-full bg-blue-600/10 px-4 py-1 text-sm font-semibold uppercase tracking-widest text-blue-700">
                    Bientôt disponible
                </span>

                <h2 class="mt-6 font-display text-4xl font-bold text-navy-950">
                    Programme de la saison 2026 / 2027
                </h2>

                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                    Notre équipe d'entraîneurs finalise actuellement le programme officiel
                    des entraînements pour la saison 2026/2027.
                </p>

                <p class="mx-auto mt-4 max-w-2xl text-gray-500">
                    Le calendrier complet comprendra les jours d'entraînement,
                    les horaires des cours, les groupes d'âge ainsi que les entraîneurs
                    responsables de chaque séance. Nous souhaitons offrir la meilleure
                    expérience possible à chaque athlète avant la publication du programme définitif.
                </p>

                <p class="mt-8 text-base font-medium text-blue-700">
                    Restez connectés — le programme complet sera annoncé très prochainement !
                </p>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-16 text-center">
            <a href="/#join"
               class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-3.5 text-sm font-bold tracking-wide text-white shadow-glow transition duration-300 hover:-translate-y-1 hover:bg-blue-500">
                Rejoindre le club
            </a>
        </div>

    </div>
</section>
@endsection
