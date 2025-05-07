<x-guest-layout>
    <div class="max-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('images/image3.png') }}');">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-md p-10 rounded-lg shadow-2xl ring-1 ring-white/20">
            <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-8">
                Connexion à <span class="text-pink-300">Elios</span>
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-pink-200" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" name="email" type="email" required autofocus :value="old('email')"
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-200" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-white" />
                    <x-text-input id="password" name="password" type="password" required
                        class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-200" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm text-white">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded lg text-pink-400 border-gray-300 focus:ring-pink-300">
                        <span class="ml-2">Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="underline hover:text-pink-300">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div class="flex justify-center">
                    <button class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-6 py-2 rounded lg transition duration-200">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
