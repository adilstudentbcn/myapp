<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocket Jobs</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="min-h-screen px-10">


        <nav class="flex justify-between items-center py-4">

            <a href="/" class="flex justify-between items-center">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo" class="w-12 h-auto">
                <span class="font-bold text-lg">Rocket</span>
            </a>

            @if (!request()->routeIs('jobs.browse'))
                <a href="{{ route('jobs.browse') }}" class="hover:text-amber-400 transition">
                    <span class="font-bold text-lg">Browse Jobs</span>
                </a>
            @endif

            <div class="space-x-6 font-bold flex items-center">
                @auth
                    <a href="{{ route('employer.jobs.create') }}" class="hover:text-amber-400">
                        Post a Job
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-amber-400">
                        Post a Job
                    </a>
                @endauth


                @guest
                    <a href="/login" class="hover:text-amber-400">Login</a>
                    <a href="/register" class="hover:text-amber-400">Register</a>
                @endguest

                @auth
                    <a href="{{ route('employer.jobs.index')}}" class="hover:text-amber-400">Dashboard</a>

                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button class="hover:text-amber-400">Logout</button>
                    </form>
                @endauth

                @auth
                    <a href="{{ route('employer.profile.edit') }}" class="hover:text-amber-400">
                        Employer profile
                    </a>
                @endauth

            </div>
        </nav>



        <main class="mt-10 max-w-6xl mx-auto">
            {{ $slot }}
        </main>

    </div>
</body>

</html>