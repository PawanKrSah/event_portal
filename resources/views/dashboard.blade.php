<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full space-y-12">

            @if (session('success'))
            <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900 dark:text-green-200 shadow-md rounded-r-lg">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:text-red-200 shadow-md rounded-r-lg">
                {{ session('error') }}
            </div>
            @endif

            <div>
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6 border-b pb-2 dark:border-gray-700">
                    Registered Events, Lactures and Workshops
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($myEvents as $event)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-700 flex flex-col relative">
                        <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg z-10">
                            ✓ Registered
                        </div>
                        <div class="p-6 flex-grow mt-2">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 mb-4">{{ $event->title }}</h4>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                                <p>📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y • h:i A') }}</p>
                                <p>📍 {{ $event->venue }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 mt-auto">
                            <form action="{{ route('events.cancel', $event->id) }}" method="POST" onsubmit="return confirm('Cancel registration?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 font-semibold py-2 px-4 rounded-lg transition-colors border border-red-200 dark:border-red-800">
                                    Drop Out
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 dark:text-gray-400 italic col-span-full">You have no upcoming events scheduled.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-8">
                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6 border-b pb-2 dark:border-gray-700">
                    Discover New Events
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($availableEvents as $event)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 flex flex-col">
                        <div class="p-6 flex-grow">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 mb-4">{{ $event->title }}</h4>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300 mb-4">
                                <p>📅 {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y • h:i A') }}</p>
                                <p>📍 {{ $event->venue }}</p>
                                @php $slotsLeft = $event->max_capacity - $event->registrations_count; @endphp
                                <p class="font-bold {{ $slotsLeft > 0 ? 'text-indigo-600 dark:text-indigo-400' : 'text-red-600 dark:text-red-400' }}">
                                    🎟️ Slots Left: {{ max(0, $slotsLeft) }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 mt-auto">
                            <form action="{{ route('events.register', $event->id) }}" method="POST">
                                @csrf
                                @if($slotsLeft > 0)
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                                    Register Now
                                </button>
                                @else
                                <button disabled class="w-full bg-gray-400 text-white font-semibold py-2.5 px-4 rounded-lg cursor-not-allowed">
                                    Event Full
                                </button>
                                @endif
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-10 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                        <p class="text-gray-500 dark:text-gray-400">You've registered for all available events, or no new events are currently listed!</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </main>

    </div>
</x-app-layout>