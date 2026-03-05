<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Student Events') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v=3">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
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

<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 min-h-screen flex flex-col transition-colors duration-300">

    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('logo.png') }}" alt="ADBU Logo" class="h-10 w-auto transform group-hover:scale-105 transition-transform drop-shadow-sm">

                    <h1 class="text-xl font-extrabold text-gray-900 dark:text-white tracking-tight">ADBU Student Event</h1>
                </a>
            </div>

            <div class="flex items-center gap-4">

                <button id="theme-toggle" class="p-2 text-xl hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full focus:outline-none transition">
                    <span id="theme-toggle-dark-icon" class="hidden">🌙</span>
                    <span id="theme-toggle-light-icon" class="hidden">☀️</span>
                </button>

                @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth



                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition focus:outline-none">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg py-1 z-50"
                            style="display: none;">

                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Dashboard
                            </a>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Profile
                            </a>

                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Register</a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900 dark:text-green-200 shadow-md rounded-r-lg max-w-2xl mx-auto">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:text-red-200 shadow-md rounded-r-lg max-w-2xl mx-auto">
            {{ session('error') }}
        </div>
        @endif

        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                Discover Campus Opportunities
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Stay updated with the latest workshops, guest lectures, and student activities. Register now to secure your spot!
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($events as $event)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 flex flex-col hover:shadow-lg transition-shadow duration-300">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2">
                            {{ $event->title }}
                        </h3>
                    </div>

                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                        <p class="flex items-center gap-2">
                            📅 <span>{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y • h:i A') }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            📍 <span>{{ $event->venue }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            👥 <span>Capacity: {{ $event->max_capacity }}</span>
                        </p>

                        @php
                        $slotsLeft = $event->max_capacity - $event->registrations_count;
                        @endphp
                        <p class="flex items-center gap-2 font-bold {{ $slotsLeft > 0 ? 'text-indigo-600 dark:text-indigo-400' : 'text-red-600 dark:text-red-400' }}">
                            🎟️ <span>Slots Left: {{ max(0, $slotsLeft) }}</span>
                        </p>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3">
                        {{ $event->description }}
                    </p>
                </div>

                <div class="p-6 pt-0 mt-auto">
                    @auth
                    <form action="{{ route('events.register', $event->id) }}" method="POST">
                        @csrf
                        @if(auth()->user()->events->contains($event->id))
                        <button disabled class="w-full bg-green-500 text-white font-semibold py-2.5 px-4 rounded-lg cursor-not-allowed">
                            ✓ Registered
                        </button>
                        @elseif($event->registrations->count() >= $event->max_capacity)
                        <button disabled class="w-full bg-red-500 text-white font-semibold py-2.5 px-4 rounded-lg cursor-not-allowed">
                            Event Full
                        </button>
                        @else
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                            Register for Event
                        </button>
                        @endif
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="block text-center w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                        Register
                    </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">No upcoming events</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The admin hasn't posted any events yet. Check back later!</p>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} ADBU Student Event. All rights reserved.
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
        });
    </script>
</body>

</html>