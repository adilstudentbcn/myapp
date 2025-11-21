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
            <div class="flex justify-between items-center">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="logo" class="w-12 h-auto">
                Rocket

            </div>

            <div class="space-x-6 font-bold">
                <a href="#">Jobs link</a>
                <a href="#">Careers link</a>
                <a href="#">Salaries link</a>
            </div>

            <div>
                <a href="">Post a Job</a>
            </div>
        </nav>

        <main class="mt-10 max-w-6xl mx-auto">

            {{ $slot }}

        </main>
    </div>
</body>

</html>