<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">{{ __('Modifier profil CMC') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Mettez à jour le poste de votre profil CMC.</p>
            </div>
            <a href="{{ route('user-cmcs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('Retour') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700/50 p-6 sm:p-8">
                
                <form method="POST" action="{{ route('user-cmcs.update', $userCmc) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="post" :value="__('Poste CMC')" />
                            <x-text-input id="post" name="post" type="text" class="mt-1 block w-full" :value="old('post', $userCmc->post)" required autofocus placeholder="Ex: Conseiller d'orientation, Directeur..." />
                            <x-input-error :messages="$errors->get('post')" class="mt-2" />
                            <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">
                                {{ __('Modifiez l\'intitulé de votre poste professionnel au sein du Centre de Métiers CMC.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('user-cmcs.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-xl transition-all">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-teal-600 hover:bg-teal-500 rounded-xl shadow-md shadow-teal-500/10 transition-all">
                            {{ __('Mettre à jour') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
