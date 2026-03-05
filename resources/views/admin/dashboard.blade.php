<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-3">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Admin Control Center
            </h2>

            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Post New Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full space-y-8">

            @if (session('success'))
            <div class="p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900/50 dark:text-green-300 shadow-sm rounded-r-lg">
                <div class="flex items-center gap-2 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if (session('error'))
            <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900/50 dark:text-red-300 shadow-sm rounded-r-lg">
                <div class="flex items-center gap-2 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            @php
            $totalUsers = $users->count();
            $totalEvents = $events->count();
            $totalRegistrations = $events->sum(function($event) {
            return $event->registrations->count();
            });
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-4 bg-purple-100 dark:bg-purple-900/50 rounded-lg text-purple-600 dark:text-purple-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Events</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalEvents }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="p-4 bg-green-100 dark:bg-green-900/50 rounded-lg text-green-600 dark:text-green-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Registrations</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalRegistrations }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Event Management</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="p-4 font-semibold">Date</th>
                                <th class="p-4 font-semibold">Event Title</th>
                                <th class="p-4 font-semibold">Capacity</th>
                                <th class="p-4 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>

                        @forelse($events as $event)
                        <tbody x-data="{ showAttendees: false }" class="border-b border-gray-100 dark:border-gray-700">

                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors">
                                <td class="p-4 text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                                </td>
                                <td class="p-4 text-gray-900 dark:text-gray-100 font-bold">
                                    {{ $event->title }}
                                </td>
                                <td class="p-4">
                                    @php
                                    $registered = $event->registrations->count();
                                    $capacity = $event->max_capacity;
                                    $isFull = $registered >= $capacity;
                                    @endphp
                                    <div class="flex flex-col gap-1">
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full {{ $isFull ? 'bg-red-500' : 'bg-indigo-500' }}" style="width: {{ min(($registered / $capacity) * 100, 100) }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium {{ $isFull ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
                                            {{ $registered }} / {{ $capacity }} Registered
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center gap-4">
                                        <button @click="showAttendees = !showAttendees" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-semibold text-sm transition-colors flex items-center gap-1">
                                            <span x-text="showAttendees ? 'Hide' : 'Attendees'"></span>
                                            <svg class="w-4 h-4 transform transition-transform" :class="{'rotate-180': showAttendees}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold text-sm transition-colors">Edit</a>

                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-semibold text-sm transition-colors">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <tr x-show="showAttendees" x-transition style="display: none;" class="bg-indigo-50/50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
                                <td colspan="4" class="p-4 sm:px-8 py-5">
                                    <div class="flex justify-between items-center mb-3">
                                        <h4 class="text-sm font-bold text-gray-800 dark:text-gray-200">Event Attendees & Communications</h4>
                                    </div>

                                    @if($registered > 0)
                                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden bg-white dark:bg-gray-800">
                                        <table class="w-full text-left text-xs">
                                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                                <tr>
                                                    <th class="px-4 py-2 font-semibold">Name</th>
                                                    <th class="px-4 py-2 font-semibold">Email</th>
                                                    <th class="px-4 py-2 font-semibold">Student ID</th>
                                                    <th class="px-4 py-2 font-semibold text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                                @foreach($event->registrations as $student)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                                    <td class="px-4 py-2 font-medium text-gray-900 dark:text-white">{{ $student->name }}</td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400">{{ $student->email }}</td>
                                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-400 font-mono">{{ $student->student_id ?? 'Not Provided' }}</td>
                                                    <td class="px-4 py-2 text-right">
                                                        <form action="{{ route('admin.events.remove_student', ['event' => $event->id, 'user' => $student->id]) }}" method="POST" class="m-0 inline-block" onsubmit="return confirm('Are you sure you want to remove {{ $student->name }} from this event?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-semibold transition-colors">
                                                                Remove
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class="mb-5 bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                        <form action="{{ route('admin.events.notify', $event->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <label for="message-{{ $event->id }}" class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">
                                                Broadcast Alert to All Registered Students
                                            </label>
                                            <div class="flex flex-col sm:flex-row gap-3">
                                                <input type="text" name="message" id="message-{{ $event->id }}" required
                                                    placeholder="e.g., Venue changed to Room 204! Please bring your laptops."
                                                    class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors">

                                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md text-sm font-bold transition-all shadow-sm hover:shadow flex items-center justify-center gap-2 whitespace-nowrap">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                    Send Alert
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                    @else
                                    <div class="text-center py-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-sm text-gray-500 dark:text-gray-400 italic">
                                        No students have registered for this event yet.
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @empty
                        <tbody>
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    No events created yet. Click "Create New Event" to get started.
                                </td>
                            </tr>
                        </tbody>
                        @endforelse
                    </table>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">User & Role Management</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="p-4 font-semibold">Name</th>
                                <th class="p-4 font-semibold">Email</th>
                                <th class="p-4 font-semibold">Student ID</th>
                                <th class="p-4 font-semibold">Role</th>
                                <th class="p-4 font-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20 transition-colors">
                                <td class="p-4 text-gray-900 dark:text-gray-100 font-medium">{{ $user->name }}</td>
                                <td class="p-4 text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="p-4 text-gray-600 dark:text-gray-400 font-mono">{{ $user->student_id ?? 'Not Provided' }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800' : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center flex justify-center space-x-3">
                                    @if($user->email === auth()->user()->email)
                                    <span class="text-gray-400 dark:text-gray-500 text-sm italic font-semibold">
                                        {{ strtolower($user->email) === 'admin@event.com' ? 'Super Admin (You)' : 'You' }}
                                    </span>
                                    @else
                                    @if(strtolower(auth()->user()->email) === 'admin@event.com')
                                    @if($user->role === 'admin')
                                    <form action="{{ route('admin.demote', $user->id) }}" method="POST" class="m-0" onsubmit="return confirm('Revoke admin privileges for {{ $user->name }}?');">
                                        @csrf
                                        <button type="submit" class="text-orange-600 dark:text-orange-400 hover:text-orange-800 font-semibold text-sm transition-colors">Remove Admin</button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.promote', $user->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-semibold text-sm transition-colors">Make Admin</button>
                                    </form>
                                    @endif
                                    @endif

                                    @if($user->role !== 'admin' || strtolower(auth()->user()->email) === 'admin@event.com')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this user? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 font-semibold text-sm transition-colors">Delete</button>
                                    </form>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>