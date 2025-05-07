{{-- resources/views/reflet/start.blade.php --}}
<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">
        <!-- Image de fond -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/image3.png') }}'); filter: brightness(0.4);"></div>

        <!-- Carte immersive -->
        <div class="relative z-10 max-w-3xl bg-white/10 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white animate-fade-in">
            <h1 class="text-4xl font-extrabold text-pink-200 drop-shadow mb-4">
                Bienvenue dans <span class="text-white">Reflet</span>
            </h1>

            <p class="text-lg text-gray-100 mb-6">{{ $story->description }}</p>

            <h2 class="text-2xl font-bold text-white mb-4">Que veux-tu faire ?</h2>

            <div class="space-y-4">
            @foreach ($story->chapters->where('is_first', true) as $chapter)
    @foreach ($chapter->choices as $choice)
        <a href="{{ route('chapter.show', $choice->to_chapter_id) }}"
           class="block w-full text-left"
           style="
               padding: 12px 24px;
               margin-bottom: 12px;
               background-color: rgba(255, 255, 255, 0.1);
               font-weight: 600;
               border-radius: 0.75rem;
               transition: all 0.3s ease;
               backdrop-filter: blur(8px);
               box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
               text-decoration: none;
               display: block;
               text-align: left;
           "
           onmouseover="
               this.style.transform = 'scale(1.05)';
               this.style.boxShadow = '0 0 8px rgba(217, 129, 255, 0.6)';
               this.style.backgroundColor = 'rgba(251, 156, 240, 0.18)';
               this.style.color = 'white';
           "
           onmouseout="
               this.style.transform = 'scale(1)';
               this.style.boxShadow = '0 0 5px rgba(255, 255, 255, 0.1)';
               this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
               this.style.color = '';
           ">
            {{ $choice->text }}
        </a>
    @endforeach
@endforeach

            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</x-app-layout>
