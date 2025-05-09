<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">
        
        <!-- Vue.js Mount Point -->
        <div id="vue-mount-point" class="relative z-10 max-w-3xl bg-white/10 backdrop-blur-lg p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white">
            
        </div>
    </div>

    <!-- Injection des données dans Vue.js -->
    <script>
        window.chapterData = @json($chapter);  // Injecter les données du chapitre dans Vue.js
    </script>

    <!-- Inclusion de Vue.js via Vite -->
    @vite(['resources/js/app.js'])
</x-app-layout>
