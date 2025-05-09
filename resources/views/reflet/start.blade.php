<x-app-layout>

        </div>
    </div>

    <!-- Injecte les données de l'histoire dans Vue.js -->
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
