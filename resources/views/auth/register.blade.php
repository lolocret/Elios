<x-guest-layout>
    <div class="max-h-screen flex items-center justify-center bg-black/80">
        <div class="w-full max-w-xl relative p-10 rounded-2xl shadow-2xl overflow-hidden">

            <!-- Image de fond dans la carte -->
            <div class="absolute inset-0 bg-cover bg-center z-0"
                style="background-image: url('{{ asset('images/image3.png') }}'); filter: brightness(0.6);">
            </div>

            <!-- Contenu -->
            <div class="relative z-10 backdrop-blur-lg bg-white/10 ring-1 ring-white/20 p-8 rounded-2xl">
                <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-8">
                    Créer un compte sur <span class="text-pink-300">Elios</span>
                </h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nom')" class="text-white" />
                        <x-text-input id="name" name="name" type="text" required autofocus :value="old('name')"
                            class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-pink-200" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-white" />
                        <x-text-input id="email" name="email" type="email" required :value="old('email')"
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

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-white" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full mt-1 bg-white/20 text-white border border-white/30 rounded-lg focus:ring-2 focus:ring-pink-300" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-pink-200" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between mt-6">
                        <a class="underline text-sm text-white hover:text-pink-300" href="{{ route('login') }}">
                            Déjà inscrit ?
                        </a>

                        <button class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
