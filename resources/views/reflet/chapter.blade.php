<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">
        <!-- Image de fond conditionnelle -->
        @if ($chapter->choices->count() > 0)
            <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/image3.png') }}'); filter: brightness(0.4);"></div>
        @else
            <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/image4.png') }}'); filter: brightness(0.4);"></div>
        @endif

        <!-- Carte immersive -->
        <div class="relative z-10 max-w-3xl bg-white/10 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white chapter">
            <h1 class="text-4xl font-extrabold text-pink-200 drop-shadow mb-6 text-typewriter">{{ $chapter->title }}</h1>

            <p class="text-lg text-gray-100 mb-8 text-typewriter">{{ $chapter->content }}</p>

            @if ($chapter->choices->count() > 0)
                <h2 class="text-2xl font-bold text-white mb-6 text-typewriter">Que choisis-tu ?</h2>

                <div class="space-y-6"> <!-- Increased spacing between choices -->
                    @foreach ($chapter->choices as $choice)
                        <a href="{{ route('chapter.show', $choice->to_chapter_id) }}"
                           class="block w-full text-left bg-white/10 hover:bg-pink-300/20  hover:text-white font-semibold py-4 px-8 rounded-lg transition duration-300 backdrop-blur-md ring-1 ring-white/10 choice">
                            {{ $choice->text }}
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-pink-100 italic mt-8 text-typewriter">Fin de cette branche du récit.</p>
            @endif
        </div>
    </div>
</x-app-layout>
