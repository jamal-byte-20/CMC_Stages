<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">{{ __('Routes de l\'Application') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Liste exhaustive et interactive des routes déclarées dans Laravel.</p>
            </div>
            <!-- Client side search bar -->
            <div class="w-full sm:w-72">
                <div class="relative bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700/50 flex items-center px-3 py-1">
                    <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="route-search" placeholder="Filtrer par URI ou nom..." class="w-full border-none bg-transparent focus:ring-0 focus:outline-none placeholder-slate-400 text-xs py-2 px-1 text-slate-800 dark:text-white">
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto rounded-2xl border border-slate-100 dark:border-slate-700/50">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-900/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Méthodes</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">URI</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Nom</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Action Contrôleur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Middleware</th>
                                </tr>
                            </thead>
                            <tbody id="routes-table-body" class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                                @forelse($routes as $route)
                                    @php
                                        // Clean and list methods
                                        $methodsArray = explode(', ', $route['methods']);
                                    @endphp
                                    <tr class="route-row hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                                        <!-- Methods Badges -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($methodsArray as $method)
                                                    @php
                                                        $method = trim(strtoupper($method));
                                                        if (in_array($method, ['GET', 'HEAD'])) {
                                                            $bgClass = 'bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-300';
                                                        } elseif ($method === 'POST') {
                                                            $bgClass = 'bg-violet-50 dark:bg-violet-950/30 text-violet-700 dark:text-violet-300';
                                                        } elseif (in_array($method, ['PUT', 'PATCH'])) {
                                                            $bgClass = 'bg-amber-50 dark:bg-amber-950/30 text-amber-700 dark:text-amber-300';
                                                        } elseif ($method === 'DELETE') {
                                                            $bgClass = 'bg-rose-50 dark:bg-rose-950/30 text-rose-700 dark:text-rose-300';
                                                        } else {
                                                            $bgClass = 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300';
                                                        }
                                                    @endphp
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold {{ $bgClass }}">
                                                        {{ $method }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <!-- URI -->
                                        <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white font-mono break-all uri-cell">
                                            {{ $route['uri'] }}
                                        </td>
                                        <!-- Name -->
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300 font-mono name-cell">
                                            {{ $route['name'] ?: '—' }}
                                        </td>
                                        <!-- Action -->
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300 font-mono break-all">
                                            {{ $route['action'] }}
                                        </td>
                                        <!-- Middleware -->
                                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400 font-mono">
                                            {{ $route['middleware'] ?: '—' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                            {{ __('Aucune route disponible dans la configuration.') }}
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

    <!-- Client-side Realtime Filtering Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('route-search');
            const tableBody = document.getElementById('routes-table-body');
            const rows = tableBody.getElementsByClassName('route-row');

            searchInput.addEventListener('input', function() {
                const filter = searchInput.value.toLowerCase().trim();
                
                for (let i = 0; i < rows.length; i++) {
                    const row = rows[i];
                    const uriCell = row.querySelector('.uri-cell');
                    const nameCell = row.querySelector('.name-cell');
                    
                    const uriText = uriCell ? uriCell.textContent.toLowerCase() : '';
                    const nameText = nameCell ? nameCell.textContent.toLowerCase() : '';

                    if (uriText.includes(filter) || nameText.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    </script>
</x-app-layout>
