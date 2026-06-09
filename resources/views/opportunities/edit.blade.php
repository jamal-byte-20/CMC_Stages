<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">{{ __('Modifier opportunité') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Mettez à jour les informations de cette opportunité.</p>
            </div>
            <a href="{{ route('opportunities.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm rounded-xl transition-all">
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
                
                <form method="POST" action="{{ route('opportunities.update', $opportunity) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Titre -->
                        <div>
                            <x-input-label for="title" :value="__('Titre de l\'offre')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $opportunity->title)" required autofocus placeholder="Ex: Stage Développeur Web Fullstack Laravel" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description détaillée')" />
                            <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 transition-colors" required placeholder="Décrivez les missions, le contexte de l'entreprise, les avantages...">{{ old('description', $opportunity->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Secteur, Type & Ville -->
                        <div class="grid sm:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="secteur" :value="__('Secteur d\'activité')" />
                                <x-text-input id="secteur" name="secteur" type="text" class="mt-1 block w-full" :value="old('secteur', $opportunity->secteur)" placeholder="Ex: Informatique" />
                                <x-input-error :messages="$errors->get('secteur')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="type" :value="__('Type de contrat')" />
                                <select id="type" name="type" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 transition-colors py-2 px-3">
                                    <option value="" disabled {{ old('type', $opportunity->type) ? '' : 'selected' }}>{{ __('Sélectionnez un type') }}</option>
                                    <option value="Stage" {{ old('type', $opportunity->type) === 'Stage' ? 'selected' : '' }}>{{ __('Stage') }}</option>
                                    <option value="CDD" {{ old('type', $opportunity->type) === 'CDD' ? 'selected' : '' }}>{{ __('CDD') }}</option>
                                    <option value="CDI" {{ old('type', $opportunity->type) === 'CDI' ? 'selected' : '' }}>{{ __('CDI') }}</option>
                                    <option value="Alternance" {{ old('type', $opportunity->type) === 'Alternance' ? 'selected' : '' }}>{{ __('Alternance') }}</option>
                                    <option value="Freelance" {{ old('type', $opportunity->type) === 'Freelance' ? 'selected' : '' }}>{{ __('Freelance') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="ville" :value="__('Ville')" />
                                <x-text-input id="ville" name="ville" type="text" class="mt-1 block w-full" :value="old('ville', $opportunity->ville)" placeholder="Ex: Casablanca" />
                                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Niveau & Profil requis -->
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="niveau" :value="__('Niveau d\'études')" />
                                <select id="niveau" name="niveau" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 transition-colors py-2 px-3">
                                    <option value="" disabled {{ old('niveau', $opportunity->niveau) ? '' : 'selected' }}>{{ __('Sélectionnez un niveau') }}</option>
                                    <option value="Bac" {{ old('niveau', $opportunity->niveau) === 'Bac' ? 'selected' : '' }}>{{ __('Bac') }}</option>
                                    <option value="Bac+2" {{ old('niveau', $opportunity->niveau) === 'Bac+2' ? 'selected' : '' }}>{{ __('Bac+2') }}</option>
                                    <option value="Bac+3" {{ old('niveau', $opportunity->niveau) === 'Bac+3' ? 'selected' : '' }}>{{ __('Bac+3') }}</option>
                                    <option value="Bac+4" {{ old('niveau', $opportunity->niveau) === 'Bac+4' ? 'selected' : '' }}>{{ __('Bac+4') }}</option>
                                    <option value="Bac+5" {{ old('niveau', $opportunity->niveau) === 'Bac+5' ? 'selected' : '' }}>{{ __('Bac+5') }}</option>
                                    <option value="Bac+8" {{ old('niveau', $opportunity->niveau) === 'Bac+8' ? 'selected' : '' }}>{{ __('Bac+8') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('niveau')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="profil_requis" :value="__('Profil recherché (Mots clés / Compétences)')" />
                                <x-text-input id="profil_requis" name="profil_requis" type="text" class="mt-1 block w-full" :value="old('profil_requis', $opportunity->profil_requis)" placeholder="Ex: PHP, Javascript, MySQL" />
                                <x-input-error :messages="$errors->get('profil_requis')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('opportunities.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-xl transition-all">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-xl shadow-md shadow-indigo-500/10 transition-all">
                            {{ __('Mettre à jour') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
