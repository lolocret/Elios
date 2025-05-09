<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">
        <!-- Image de fond conditionnelle -->
        @if ($chapter->choices->count() > 0)
            <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/image3.png') }}'); filter: brightness(0.4);"></div>
        @else
            <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('{{ asset('images/image4.png') }}'); filter: brightness(0.4);"></div>
        @endif

        <!-- Vue.js Mount Point -->
        <div id="vue-mount-point" class="relative z-10 max-w-3xl bg-white/10 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white">
            <!-- Vue.js gérera le contenu dynamique ici -->
        </div>
    </div>

    <!-- Injection des données dans Vue.js -->
    <script>
        window.chapterData = @json($chapter);  // Injecter les données du chapitre dans Vue.js
    </script>

    <!-- Inclusion de Vue.js via Vite -->
    @vite(['resources/js/app.js'])
</x-app-layout>
