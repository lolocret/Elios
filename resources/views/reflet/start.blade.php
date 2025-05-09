<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-black relative overflow-hidden">
        <!-- L'image de fond sera gérée par Vue.js -->
        <div id="vue-mount-point" class="relative z-10 max-w-3xl p-10 rounded-2xl shadow-2xl ring-1 ring-white/10 text-white animate-fade-in">
            <!-- Le contenu sera géré par Vue.js -->
        </div>
    </div>

    <!-- Injecter les données de l'histoire dans Vue.js -->
    <script>
        window.storyData = @json($story);  // Injecte les données de l'histoire depuis Blade
    </script>

    <!-- Inclusion de Vue.js via Vite -->
    @vite(['resources/js/app.js'])

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
