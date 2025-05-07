<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elios</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-cover bg-center flex items-center justify-center text-white"
      style="background-image: url('{{ asset('images/image2.png') }}');">

    <div class="backdrop-blur-md bg-black/40 p-10 rounded-2xl shadow-lg text-center space-y-6">
        <h1 class="text-4xl font-bold drop-shadow-xl">Bienvenue sur <span class="text-pink-300">Elios</span></h1>
        <p class="text-lg text-white/80">Une immersion virtuelle à travers des histoires interactives.</p>

        <div class="flex justify-center gap-6 pt-4">
            <a href="{{ route('login') }}"
               class="bg-pink-400/95 hover:bg-pink-400/80 transition px-6 py-2 rounded-lg text-white font-medium shadow-md">
                Se connecter
            </a>
            <a href="{{ route('register') }}"
               class="bg-white/10 hover:bg-white/20 transition px-6 py-2 rounded-lg text-white font-medium border border-white/20">
                S’inscrire
            </a>
        </div>
    </div>

</body>

</html>
