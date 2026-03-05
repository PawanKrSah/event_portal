<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\User;
use App\Http\Middleware\AdminMiddleware;

// 1. PUBLIC ROUTE
Route::get('/', function () {
    // Fetch events that are happening today or in the future, 
    // and sort them so the closest date appears first.
    $events = Event::withCount('registrations')
        ->where('event_date', '>=', now()) // Hides past events
        ->orderBy('event_date', 'asc')     // Arranges chronologically (soonest first)
        ->get();

    return view('welcome', compact('events'));
})->name('home');
// 2. PROTECTED ROUTES
Route::middleware(['auth', 'verified'])->group(function () {

    // Smart Dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 1. Fetch Registered Events
        $myEvents = auth()->user()->events()
            ->withCount('registrations')
            ->orderBy('event_date', 'asc')
            ->get();

        $myEventIds = $myEvents->pluck('id');

        // 2. Fetch Notifications only for the events this student is registered for
        $notifications = \App\Models\EventNotification::whereIn('event_id', $myEventIds)
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Fetch Available Events (Future events they are NOT registered for)
        $availableEvents = Event::whereNotIn('id', $myEventIds)
            ->withCount('registrations')
            ->where('event_date', '>=', now()) // Only show upcoming events
            ->orderBy('event_date', 'asc')
            ->get();

        return view('dashboard', compact('myEvents', 'notifications', 'availableEvents'));
    })->name('dashboard');

    // Student Event Registration & Cancellation Routes
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    Route::delete('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');

    // ----------------------------------------------------
    // ADMIN ONLY ROUTES
    // ----------------------------------------------------
    Route::middleware(AdminMiddleware::class)->prefix('admin')->group(function () {

        // 1. Dashboard (With Eager Loading for Attendee Management)
        Route::get('/dashboard', function () {
            $users = User::all();
            $events = Event::with('registrations')->orderBy('event_date', 'desc')->get();
            return view('admin.dashboard', compact('users', 'events'));
        })->name('admin.dashboard');

        // 2. Student & Admin Role Management (SUPER ADMIN ONLY)
        Route::post('/promote/{user}', function (User $user) {

            // 1. UNCOMMENT THIS LINE TO DEBUG IF IT FAILS AGAIN:
            // dd('Button clicked!', 'Logged in as: ' . auth()->user()->email, 'Target user: ' . $user->name);

            if (strtolower(auth()->user()->email) !== 'admin@event.com') {
                return back()->with('error', 'Access Denied: Only the Super Admin can promote users.');
            }

            // 2. Now that 'role' is fillable, we can use the ultra-reliable update() method
            $user->update(['role' => 'admin']);

            return back()->with('success', $user->name . ' has been promoted to Admin.');
        })->name('admin.promote');

        Route::post('/demote/{user}', function (User $user) {
            if (auth()->user()->email !== 'admin@event.com') {
                return back()->with('error', 'Access Denied: Only the Super Admin can revoke admin rights.');
            }
            if ($user->email === 'admin@event.com') {
                return back()->with('error', 'The Super Admin cannot be demoted.');
            }

            // Bypass Mass Assignment by declaring it directly
            $user->role = 'student';
            $user->save();

            return back()->with('success', $user->name . ' is now a regular Student.');
        })->name('admin.demote');

        Route::delete('/users/{user}', function (User $user) {
            // Prevent anyone from deleting the Super Admin
            if ($user->email === 'admin@event.com') {
                return back()->with('error', 'The Super Admin cannot be deleted.');
            }

            // Prevent regular Admins from deleting other Admins
            if ($user->role === 'admin' && auth()->user()->email !== 'admin@event.com') {
                return back()->with('error', 'Only the Super Admin can delete other Admins.');
            }

            // Free the slots and delete the user
            $user->events()->detach();
            $user->delete();
            return back()->with('success', 'User deleted and their event slots have been freed.');
        })->name('admin.users.destroy');

        // 3. Event Management (CRUD)
        Route::get('/events/create', function () {
            return view('admin.events.create');
        })->name('admin.events.create');

        Route::post('/events/store', [EventController::class, 'store'])->name('admin.events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');

        // 4. Event Attendee Management (Safely tucked inside Admin group)
        Route::delete('/events/{event}/remove-student/{user}', [EventController::class, 'removeStudent'])->name('admin.events.remove_student');
        Route::post('/events/{event}/notify', [EventController::class, 'notifyStudents'])->name('admin.events.notify');
    });

    // ----------------------------------------------------
    // USER PROFILE ROUTES
    // ----------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
