<x-guest-layout>
    <div class="max-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/image3.png') }}');">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-md p-10 rounded-lg shadow-2xl ring-1 ring-white/20">
            <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-6">
                🔐 Réinitialisation du mot de passe
            </h2>

            <p class="text-sm text-gray-200 mb-6 text-center">
                {{ __('Mot de passe oublié ? Aucun souci. Entrez votre adresse e-mail pour recevoir un lien sécurisé.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-pink-200" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" name="email" type="email" required autofocus
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-200" />
                </div>

                <!-- Submit -->
                <div class="flex justify-center">
                    <button class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-6 py-2 rounded lg transition duration-200">
                        Envoyer le lien
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
