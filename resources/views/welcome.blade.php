<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMC Stages — Trouver des stagiaires & partenaires</title>
    <meta name="description" content="Plateforme de mise en relation entre stagiaires et partenaires CMC.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts / Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 dark:bg-slate-900 dark:text-slate-100 min-h-screen flex flex-col selection:bg-teal-500 selection:text-white">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-b border-slate-200/50 dark:border-slate-800/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-500 to-indigo-600 flex items-center justify-center text-white font-extrabold shadow-md shadow-teal-500/20">
                    CMC
                </div>
                <div>
                    <span class="block font-bold text-slate-900 dark:text-white tracking-tight leading-none text-base">Centre de Métiers CMC</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Stages & Partenariats</span>
                </div>
            </div>



            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 dark:bg-teal-600 dark:hover:bg-teal-500 rounded-xl shadow-sm transition-all">
                            {{ __('Tableau de bord') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 px-3 py-2 transition-colors">
                            {{ __('Connexion') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-teal-500 to-indigo-600 hover:opacity-90 rounded-xl shadow-md shadow-teal-500/10 transition-all">
                                {{ __('S\'inscrire') }}
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-16 lg:py-24">
            <!-- Decorative Background Gradients -->
            <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-teal-400/20 blur-3xl -z-10"></div>
            <div class="absolute top-60 -left-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl -z-10"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Column: Copywriting & Search -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950 dark:text-teal-200 border border-teal-200/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                            Faciliter l'accès aux stages
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                            Trouvez des <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-indigo-600">stagiaires</span> ou des opportunités rapidement
                        </h1>
                        
                        <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                            Connectez les stagiaires motivés avec des partenaires locaux et nationaux. Publiez des offres, gérez vos candidatures et collaborez avec facilité grâce à notre plateforme dédiée.
                        </p>

                        <!-- Search Bar -->
                        <div class="p-2 bg-white dark:bg-slate-800 rounded-2xl shadow-xl shadow-slate-100 dark:shadow-none border border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row gap-2 max-w-xl">
                            <div class="flex-grow flex items-center px-3">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="search" placeholder="Chercher par mot-clé, entreprise..." class="w-full border-none bg-transparent focus:ring-0 focus:outline-none placeholder-slate-400 text-sm py-2 px-3">
                            </div>
                            <button class="bg-teal-600 hover:bg-teal-500 text-white font-semibold text-sm px-6 py-3 rounded-xl transition-all shadow-md shadow-teal-500/10">
                                Rechercher
                            </button>
                        </div>

                        <!-- Stats Banner -->
                        <div class="pt-6 grid grid-cols-3 gap-6 max-w-md">
                            <div class="border-l-2 border-teal-500 pl-4">
                                <div class="text-3xl font-extrabold text-slate-950 dark:text-white">482</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">Offres actives</div>
                            </div>
                            <div class="border-l-2 border-teal-500 pl-4">
                                <div class="text-3xl font-extrabold text-slate-950 dark:text-white">126</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">Partenaires</div>
                            </div>
                            <div class="border-l-2 border-teal-500 pl-4">
                                <div class="text-3xl font-extrabold text-slate-950 dark:text-white">1.2k</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">Stagiaires</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: CTA Block & Partner list -->
                    <div class="lg:col-span-5 space-y-6">
                        <!-- CTA Card -->
                        <div class="bg-gradient-to-br from-slate-900 to-indigo-950 dark:from-slate-800 dark:to-slate-950 text-white rounded-3xl p-8 shadow-2xl relative overflow-hidden border border-slate-800">
                            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-teal-500/10 rounded-full blur-2xl"></div>
                            
                            <h3 class="text-2xl font-bold tracking-tight mb-2">Vous êtes partenaire ?</h3>
                            <p class="text-slate-300 text-sm leading-relaxed mb-6">
                                Rejoignez notre réseau d'entreprises partenaires, publiez vos besoins en quelques minutes et accédez à des profils de stagiaires qualifiés.
                            </p>
                            <div class="flex flex-col gap-3">
                                <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center px-4 py-3 bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold rounded-xl shadow-lg transition-colors text-center text-sm">
                                    Déposer une opportunité
                                </a>
                                <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-4 py-3 border border-slate-700 hover:border-slate-600 hover:bg-slate-800 text-slate-200 font-semibold rounded-xl transition-all text-center text-sm">
                                    Connexion espace partenaire
                                </a>
                            </div>
                        </div>

                        <!-- Help Widget -->
                        <div class="bg-teal-50 dark:bg-teal-950/20 border border-teal-100 dark:border-teal-900/50 rounded-2xl p-5 flex items-start gap-4">
                            <div class="p-3 bg-teal-500 rounded-xl text-white shadow-md shadow-teal-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Besoin d'aide ?</h4>
                                <p class="text-slate-600 dark:text-slate-400 text-xs mt-1">
                                    Notre équipe CMC vous conseille et vous accompagne dans le recrutement de vos futurs talents.
                                </p>
                                <a href="mailto:contact@cmc.ma" class="inline-flex items-center gap-1 text-teal-600 dark:text-teal-400 text-xs font-bold mt-2 hover:underline">
                                    Nous contacter
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Partners Grid Section -->
        <section id="partenaires" class="py-12 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-xl mx-auto mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Nos entreprises partenaires</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Plusieurs entreprises nous font confiance pour recruter leurs collaborateurs.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                    @php
                        $demoPartners = ['Opcio', 'Inova', 'Capgemini', 'Société Générale', 'Direct Stage', 'Digitize'];
                    @endphp
                    @foreach($demoPartners as $partner)
                        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/50 rounded-xl p-4 flex items-center justify-center text-center font-medium text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors shadow-sm">
                            {{ $partner }}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-slate-500 dark:text-slate-400 py-8 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                &copy; {{ date('Y') }} Centre de Métiers CMC. Tous droits réservés.
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:text-teal-500 transition-colors">Mentions légales</a>
                <a href="#" class="hover:text-teal-500 transition-colors">Confidentialité</a>
                <a href="#" class="hover:text-teal-500 transition-colors">Support</a>
            </div>
        </div>
    </footer>

</body>
</html>
