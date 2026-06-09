<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Créer un compte') }}</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('Rejoignez la plateforme CMC Stages et Partenariats') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ex: Jamal Kerroumi" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Ex: jamal@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role Selector -->
        <div>
            <x-input-label for="role" :value="__('Type d\'inscription')" />
            <select id="role" name="role" required class="block mt-1 w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-teal-500 focus:ring-teal-500 transition-colors">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>{{ __('Choisissez votre profil') }}</option>
                <option value="cmc" {{ old('role') === 'cmc' ? 'selected' : '' }}>{{ __('Utilisateur CMC') }}</option>
                <option value="partenaire" {{ old('role') === 'partenaire' ? 'selected' : '' }}>{{ __('Partenaire (Entreprise)') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Conditional Fields: CMC Profile -->
        <div id="cmc-fields" class="hidden space-y-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800/50 transition-all duration-300">
            <div>
                <x-input-label for="post" :value="__('Poste CMC occupé')" />
                <x-text-input id="post" class="block mt-1 w-full" type="text" name="post" :value="old('post')" autocomplete="off" placeholder="Ex: Directeur, Conseiller..." />
                <x-input-error :messages="$errors->get('post')" class="mt-2" />
            </div>
        </div>

        <!-- Conditional Fields: Partenaire Profile -->
        <div id="partenaire-fields" class="hidden space-y-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800/50 transition-all duration-300">
            <div>
                <x-input-label for="phone" :value="__('Téléphone de contact')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autocomplete="tel" placeholder="Ex: +212 600 000000" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="city" :value="__('Ville')" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autocomplete="address-level2" placeholder="Ex: Casablanca" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Adresse')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" autocomplete="street-address" placeholder="Ex: Bd Anfa" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="text-sm text-slate-600 dark:text-slate-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-teal-500 to-indigo-600 hover:opacity-95 rounded-xl shadow-md shadow-teal-500/10 transition-all">
                {{ __('S\'inscrire') }}
            </button>
        </div>
    </form>

    <script>
        function updateRoleFields() {
            const role = document.getElementById('role').value;
            const cmcFields = document.getElementById('cmc-fields');
            const partenaireFields = document.getElementById('partenaire-fields');

            // Hide/Show CMC Fields
            if (role === 'cmc') {
                cmcFields.classList.remove('hidden');
                cmcFields.querySelectorAll('input').forEach(el => el.disabled = false);
            } else {
                cmcFields.classList.add('hidden');
                cmcFields.querySelectorAll('input').forEach(el => el.disabled = true);
            }

            // Hide/Show Partenaire Fields
            if (role === 'partenaire') {
                partenaireFields.classList.remove('hidden');
                partenaireFields.querySelectorAll('input').forEach(el => el.disabled = false);
            } else {
                partenaireFields.classList.add('hidden');
                partenaireFields.querySelectorAll('input').forEach(el => el.disabled = true);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            roleSelect.addEventListener('change', updateRoleFields);
            updateRoleFields();
        });
    </script>
</x-guest-layout>
