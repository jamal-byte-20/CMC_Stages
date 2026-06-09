<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-100 leading-tight">{{ __('Modifier partenaire') }}</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Mettez à jour les informations de ce partenaire entreprise.</p>
            </div>
            <a href="{{ route('partenaires.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm rounded-xl transition-all">
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
                
                <form method="POST" action="{{ route('partenaires.update', $partenaire) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Nom -->
                        <div>
                            <x-input-label for="name" :value="__('Nom de l\'entreprise / partenaire')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $partenaire->user->name) }}" required autofocus placeholder="Ex: Opcio SA" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Adresse Email de contact')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $partenaire->user->email) }}" required placeholder="Ex: contact@opcio.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Nouveau mot de passe (laisser vide pour ne pas modifier)')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Phone & City -->
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="phone" :value="__('Téléphone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ old('phone', $partenaire->phone) }}" placeholder="Ex: +212 522 000000" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('Ville')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" value="{{ old('city', $partenaire->city) }}" placeholder="Ex: Casablanca" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div>
                            <x-input-label for="address" :value="__('Adresse physique')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address', $partenaire->address) }}" placeholder="Ex: 120 Bd d'Anfa, 3ème étage" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                        <a href="{{ route('partenaires.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 rounded-xl transition-all">
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
