<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/image3.png') }}');">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-md p-10 rounded-lg shadow-2xl ring-1 ring-white/20">
            <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-6">
                🔒 Réinitialiser le mot de passe
            </h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Token caché -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" type="email" name="email" required autofocus
                        :value="old('email', $request->email)"
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300"
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-200" />
                </div>

                <!-- New password -->
                <div>
                    <x-input-label for="password" :value="__('Nouveau mot de passe')" class="text-white" />
                    <x-text-input id="password" type="password" name="password" required
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-200" />
                </div>

                <!-- Confirm password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-white" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-200" />
                </div>

                <!-- Button -->
                <div class="flex justify-center pt-2">
                    <button class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-6 py-2 rounded lg transition duration-200">
                        Réinitialiser
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
