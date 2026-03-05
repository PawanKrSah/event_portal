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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">

        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <div class="flex items-center gap-4">
                        <a href="/" class="flex items-center gap-3 group">
                            <img src="{{ asset('logo.png') }}" alt="ADBU Logo" class="h-10 w-auto transform group-hover:scale-105 transition-transform drop-shadow-sm">

                            <span class="text-xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                ADBU Student Event
                            </span>
                        </a>
                    </div>

                    <div class="flex items-center gap-4">

                        <button onclick="toggleTheme()" class="p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                            <span id="theme-icon-light" class="hidden">☀️</span>
                            <span id="theme-icon-dark" class="hidden">🌙</span>
                        </button>

                        @php
                        if (auth()->user()->role === 'admin') {
                        $userNotifications = \App\Models\EventNotification::with('event')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
                        } else {
                        $userNotifications = \App\Models\EventNotification::whereIn('event_id', auth()->user()->events->pluck('id'))
                        ->with('event')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
                        }

                        $latestNotificationId = $userNotifications->first() ? $userNotifications->first()->id : 0;
                        @endphp

                        <div class="relative"
                            x-data="{ 
                                 open: false, 
                                 latestId: {{ $latestNotificationId }},
                                 seenId: localStorage.getItem('seen_notifs_user_{{ auth()->id() }}') || 0
                             }"
                            @click.away="open = false">

                            <button @click="open = !open; localStorage.setItem('seen_notifs_user_{{ auth()->id() }}', latestId); seenId = latestId;"
                                class="relative p-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full focus:outline-none transition">

                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>

                                <template x-if="latestId > 0 && latestId > seenId">
                                    <span class="absolute top-1 right-1 flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                    </span>
                                </template>
                            </button>

                            <div x-show="open" x-transition class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 border border-gray-200 dark:border-gray-700" style="display: none;">
                                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ auth()->user()->role === 'admin' ? 'System Broadcasts' : 'Notifications' }}
                                    </h3>
                                </div>
                                <div class="max-h-80 overflow-y-auto">
                                    @forelse($userNotifications as $notice)
                                    <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 last:border-0 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 mb-1">{{ $notice->event->title }}</p>
                                        <p class="text-sm text-gray-800 dark:text-gray-200">{{ $notice->message }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $notice->created_at->diffForHumans() }}</p>
                                    </div>
                                    @empty
                                    <div class="px-4 py-6 text-sm text-gray-500 dark:text-gray-400 text-center">
                                        No recent notifications.
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>


                        <a href="{{ route('profile.edit') }}" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition ml-2">
                            {{ auth()->user()->name }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="ml-4 pl-4 border-l border-gray-300 dark:border-gray-600">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 transition">
                                Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </nav>

        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main class="flex-grow">
            {{ $slot }}
        </main>
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8 mt-auto w-full">
            <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} ADBU Student Event. All rights reserved.
            </div>
        </footer>
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