<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rocket Jobs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white">
    <div class="min-h-screen px-10">

        <nav class="flex items-baseline justify-between py-4">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.png') }}" 
     alt="logo" 
     class="w-12 h-auto">

                </a>
            </div>

            <div class="space-x-6">
                <a href="#">Jobs link</a>
                <a href="#">Careers link</a>
                <a href="#">Salaries link</a>
            </div>

            <div>
                <a href="">Post a Job</a>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
