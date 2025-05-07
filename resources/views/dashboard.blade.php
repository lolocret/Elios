<x-app-layout>
    <div class="min-h-screen bg-cover bg-center py-24 px-8 text-white"
         style="background-image: url('{{ asset('images/image.png') }}');">

        <div class="text-center mb-16">
            <h2 class="text-4xl font-light drop-shadow-xl tracking-wide backdrop-blur-md bg-white/10 px-8 py-4 inline-block rounded-2xl">
                {{ 'Bienvenue ' . explode(' ', Auth::user()->name)[0] . ', choisis une histoire !' }}
            </h2>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 bg-white/10 backdrop-blur-sm p-12 rounded-xl shadow-lg ring-1 ring-white/10">

            @php
                $stories = [
                    ['title' => 'Reflet', 'description' => 'Une thérapie virtuelle qui en sait plus que vous...', 'id' => 1, 'active' => true],
                    ['title' => 'Cyber Avenir', 'description' => 'Une dystopie cyberpunk.', 'active' => false],
                    ['title' => 'Légende Perdue', 'description' => 'Une aventure mystique.', 'active' => false],
                ];
            @endphp

            @foreach ($stories as $story)
                <div class="rounded-3xl p-6 shadow-md border border-white/20 backdrop-blur-lg transition hover:scale-105 duration-300
                            {{ $story['active'] ? 'bg-white/10 hover:ring-2 hover:ring-orange-300/50' : 'opacity-40 cursor-not-allowed bg-white/5' }}">
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $story['title'] }}</h3>
                    <p class="text-sm text-gray-200 mb-4">{{ $story['description'] }}</p>

                    @if ($story['active'])
                        <form method="GET" action="{{ route('story.play', $story['id']) }}">
                            <button class="block w-full text-left bg-white/10 hover:bg-orange-400/20 hover:text-white font-semibold py-4 px-8 rounded-lg transition duration-300 backdrop-blur-md ring-1 ring-white/10">
                                Commencer
                            </button>
                        </form>
                    @else
                        <p class="text-xs text-gray-300 italic">Bientôt disponible</p>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
