<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/image3.png') }}');">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-md p-10 rounded-lg shadow-2xl ring-1 ring-white/20">
            <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-6">
                🛡️ Confirmation requise
            </h2>

            <p class="text-sm text-gray-200 mb-6 text-center">
                {{ __('Zone sécurisée. Merci de confirmer votre mot de passe pour continuer.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-white" />
                    <x-text-input id="password" name="password" type="password" required
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300"
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-200" />
                </div>

                <!-- Button -->
                <div class="flex justify-center">
                    <button class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-6 py-2 rounded lg transition duration-200">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
