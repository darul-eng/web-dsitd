<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('img/logo-dark.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title')@yield('title') | @endif{{ config('app.name') }}</title>

    <!-- Fonts: Inter for precision technical feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .mesh-gradient {
            background-color: #020617;
            background-image:
                radial-gradient(at 0% 0%, hsla(220, 100%, 50%, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(0, 100%, 50%, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, hsla(220, 100%, 50%, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(0, 100%, 50%, 0.05) 0px, transparent 50%);
        }

        @keyframes fade-up {
            from { opacity: 0; transform: translateY(30px); filter: blur(10px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-fade-up {
            animation: fade-up 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-bounce-slow {
            animation: bounce-slow 4s ease-in-out infinite;
        }

        .delay-150 { animation-delay: 150ms; }
        .delay-300 { animation-delay: 300ms; }

        .text-glow {
            text-shadow: 0 0 30px rgba(239, 68, 68, 0.5);
        }
    </style>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="antialiased text-slate-900 bg-white selection:bg-red-100 selection:text-red-700">
    {{ $slot }}

    @livewireScripts
</body>

</html>
