<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Banner Card -->
            <div class="bg-gradient-to-r from-teal-500 to-indigo-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-teal-500/10 relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 space-y-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-300 animate-pulse"></span>
                        {{ __('Espace Connecté') }}
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        {{ __('Bienvenue de retour, :name', ['name' => Auth::user()->name]) }}
                    </h3>
                    <p class="text-sm sm:text-base text-teal-50 max-w-2xl">
                        {{ __('Utilisez votre espace personnalisé pour gérer les partenariats de stage, publier des opportunités et piloter vos processus métier.') }}
                    </p>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid gap-6 md:grid-cols-3">

                <!-- Column 1: Profile and Role Status -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50 flex flex-col justify-between">
                    <div>
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-4">{{ __('Votre Statut') }}</h4>
                        
                        <div class="space-y-4">
                            @if(Auth::user()->isCmc())
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/30 flex items-center justify-center text-teal-600 dark:text-teal-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-900 dark:text-white">{{ __('Rôle : CMC') }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ __('Poste : ') }} <span class="font-medium text-slate-700 dark:text-slate-300">{{ Auth::user()->userCmc->post }}</span></div>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                                    {{ __('Vous possédez les droits d\'administration des partenaires et de consultation des routes de l\'application.') }}
                                </p>
                            @elseif(Auth::user()->isPartenaire())
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-900 dark:text-white">{{ __('Rôle : Partenaire') }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ __('Ville : ') }} <span class="font-medium text-slate-700 dark:text-slate-300">{{ Auth::user()->partenaire->city ?? '—' }}</span></div>
                                    </div>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">
                                    {{ __('Vous pouvez déposer des offres de stage et gérer vos opportunités actives.') }}
                                </p>
                            @else
                                <div class="p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/20 border border-amber-100 dark:border-amber-900/50 text-amber-800 dark:text-amber-300 space-y-3">
                                    <div class="flex gap-2">
                                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        <div>
                                            <div class="font-bold text-sm">{{ __('Aucun rôle assigné') }}</div>
                                            <p class="text-xs mt-1 text-amber-700 dark:text-amber-400">
                                                {{ __('Votre compte n\'est actuellement rattaché à aucun profil actif.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- CTA for Non-roles -->
                    @if(!Auth::user()->isCmc() && !Auth::user()->isPartenaire())
                        <div class="pt-6 border-t border-slate-100 dark:border-slate-700/50 mt-6">
                            <a href="{{ route('user-cmcs.create') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-teal-500 to-indigo-600 hover:opacity-95 text-white font-semibold text-sm rounded-xl transition-all shadow-md">
                                {{ __('Créer un profil CMC') }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Column 2 & 3: Actions Rapides (Dynamic by role) -->
                <div class="md:col-span-2 bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700/50">
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-4">{{ __('Actions rapides') }}</h4>
                    
                    <div class="grid gap-4 sm:grid-cols-2">
                        @if(Auth::user()->isCmc())
                            <!-- Gérer les partenaires -->
                            <a href="{{ route('partenaires.index') }}" class="group p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-teal-500 dark:hover:border-teal-500 transition-all flex flex-col justify-between gap-4">
                                <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/30 flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-950 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">{{ __('Gérer les partenaires') }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Consulter, ajouter et mettre à jour vos partenaires professionnels.') }}</p>
                                </div>
                            </a>

                            <!-- Votre profil CMC -->
                            <a href="{{ route('user-cmcs.index') }}" class="group p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-teal-500 dark:hover:border-teal-500 transition-all flex flex-col justify-between gap-4">
                                <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/30 flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-950 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">{{ __('Votre profil CMC') }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Gérer vos informations de poste et d\'activité CMC.') }}</p>
                                </div>
                            </a>

                            <!-- Consulter les opportunités -->
                            <a href="{{ route('opportunities.index') }}" class="group p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all flex flex-col justify-between gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-950 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ __('Toutes les opportunités') }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Consultez et filtrez toutes les offres publiées par les partenaires.') }}</p>
                                </div>
                            </a>

                        @elseif(Auth::user()->isPartenaire())
                            <!-- Gérer vos opportunités -->
                            <a href="{{ route('opportunities.index') }}" class="group p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all flex flex-col justify-between gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-950 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ __('Gérer vos opportunités') }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Modifier, archiver ou analyser vos offres de stage et d\'emploi publiées.') }}</p>
                                </div>
                            </a>

                            <!-- Nouvelle opportunité -->
                            <a href="{{ route('opportunities.create') }}" class="group p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all flex flex-col justify-between gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-950/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-950 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ __('Nouvelle opportunité') }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('Créer et publier une nouvelle offre pour attirer les candidats CMC.') }}</p>
                                </div>
                            </a>
                        @else
                            <!-- No Actions Available -->
                            <div class="sm:col-span-2 p-8 text-center text-slate-400 dark:text-slate-500 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-2xl flex flex-col items-center justify-center gap-3">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <div>
                                    <div class="font-bold text-slate-700 dark:text-slate-300">{{ __('Aucune action disponible') }}</div>
                                    <p class="text-xs max-w-sm mt-1 mx-auto">{{ __('Activez votre profil CMC en cliquant sur le bouton de gauche pour débloquer les outils métier.') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
