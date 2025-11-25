<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rocket Jobs') }}</title>

    {{-- Optional external font (you can keep or remove) --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Use the same compiled assets as the main layout --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">

        {{-- Rocket logo + name --}}
        <div class="mb-10">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Rocket logo" class="w-12 h-auto">
                <span class="font-bold text-2xl">
                    Rocket
                </span>
            </a>
        </div>

        {{-- Auth card (login / register / forgot password) --}}
        <div class="w-full max-w-md bg-zinc-900/95 border border-zinc-700/70
               rounded-2xl px-8 py-6 shadow-xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>