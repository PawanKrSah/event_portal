<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Student Events') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v=3">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-300 flex flex-col min-h-screen">

    <button onclick="toggleTheme()" class="absolute top-4 right-4 p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-800 rounded-full transition z-50">
        <span id="theme-icon-light" class="hidden">☀️</span>
        <span id="theme-icon-dark" class="hidden">🌙</span>
    </button>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div class="mb-8 text-center">
            <a href="/" class="flex flex-col items-center gap-2 group">
                <img src="{{ asset('logo.png') }}" alt="ADBU Logo" class="h-20 w-auto transform group-hover:scale-105 transition-transform drop-shadow-md">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">ADBU Student Event</h1>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-10 py-10 bg-white dark:bg-gray-800 shadow-2xl sm:rounded-2xl border border-gray-100 dark:border-gray-700 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500"></div>

            {{ $slot }}
        </div>
    </div>

    <script>
        const darkIcon = document.getElementById('theme-icon-dark');
        const lightIcon = document.getElementById('theme-icon-light');

        if (document.documentElement.classList.contains('dark')) {
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }

        function toggleTheme() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
</body>

</html>