<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center"
         style="background-image: url('{{ asset('images/image3.png') }}');">

        <div class="w-full max-w-xl bg-white/10 backdrop-blur-md p-10 rounded-lg shadow-2xl ring-1 ring-white/20">
            <h2 class="text-3xl font-bold text-center text-white drop-shadow mb-6">
                📧 Vérification de l’adresse email
            </h2>

            <div class="mb-4 text-sm text-white text-center">
                {{ __('Merci pour votre inscription ! Avant de commencer, veuillez confirmer votre adresse email en cliquant sur le lien que nous venons de vous envoyer. Si vous ne l’avez pas reçu, nous pouvons vous en renvoyer un.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-center font-medium text-sm text-pink-200">
                    {{ __('Un nouveau lien de vérification a été envoyé à l’adresse email que vous avez fournie.') }}
                </div>
            @endif

            <div class="mt-6 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button
                        class="bg-pink-400 hover:bg-pink-300 text-white font-semibold px-5 py-2 rounded transition duration-200">
                        Renvoyer l’email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="text-sm text-white underline hover:text-pink-300 transition duration-200">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
