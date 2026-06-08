<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">{{ __('Opportunités') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Consultez et administrez vos offres de stage et d'emploi.</p>
            </div>
            <div>
                <a href="{{ route('opportunities.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-500/10 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ __('Nouvelle opportunité') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('status'))
                <div class="mb-6 rounded-2xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/50 p-4 text-sm text-emerald-800 dark:text-emerald-300 flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium">{{ session('status') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-900/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Titre</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Secteur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Type</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Ville</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                                @forelse($opportunities as $opportunity)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900 dark:text-white">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm">
                                                    OP
                                                </div>
                                                {{ $opportunity->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                            {{ $opportunity->secteur ?? '—' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($opportunity->type)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/30 text-indigo-700 dark:text-indigo-300">
                                                    {{ $opportunity->type }}
                                                </span>
                                            @else
                                                <span class="text-slate-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($opportunity->ville)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200">
                                                    {{ $opportunity->ville }}
                                                </span>
                                            @else
                                                <span class="text-slate-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-3">
                                            <a href="{{ route('opportunities.edit', $opportunity) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-bold transition-colors">
                                                {{ __('Modifier') }}
                                            </a>
                                            <form action="{{ route('opportunities.destroy', $opportunity) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette opportunité ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-rose-600 hover:text-rose-500 font-bold transition-colors">
                                                    {{ __('Supprimer') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                            <div class="flex flex-col items-center justify-center gap-3">
                                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                                </svg>
                                                <div>
                                                    <div class="font-bold text-slate-700 dark:text-slate-300">{{ __('Aucune opportunité publiée') }}</div>
                                                    <p class="text-xs max-w-sm mt-1 mx-auto">{{ __('Ajoutez votre première opportunité pour recruter des stagiaires.') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
