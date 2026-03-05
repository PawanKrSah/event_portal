<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date|after:now', // Must be a future date
            'max_capacity' => 'required|integer|min:1',
        ]);

        Event::create($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'New university event posted successfully!');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'event_date' => 'required|date',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $event->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Event deleted permanently.');
    }

    /**
     * Handle student registration for an event.
     */
    public function register(Event $event)
    {
        $user = auth()->user();

        // 1. Check if the user is already registered
        if ($user->events()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'You are already registered for this event!');
        }

        // 2. Check if the event has reached max capacity
        if ($event->registrations()->count() >= $event->max_capacity) {
            return back()->with('error', 'Sorry, this event has reached maximum capacity.');
        }

        // 3. Register the user (adds a row to the event_user pivot table)
        $user->events()->attach($event->id);

        return back()->with('success', 'Successfully registered for ' . $event->title . '!');
    }

    /**
     * Handle student cancellation of an event registration.
     */
    public function cancel(Event $event)
    {
        $user = auth()->user();

        // Detach ONLY this specific event from the pivot table
        $user->events()->detach($event->id);

        return back()->with('success', 'You have successfully canceled your registration for ' . $event->title . '.');
    }

    /**
     * Admin: Remove a specific student from an event.
     */
    public function removeStudent(Event $event, User $user)
    {
        // Detach this specific user from this specific event
        $event->registrations()->detach($user->id);

        return back()->with('success', $user->name . ' has been removed from ' . $event->title . '.');
    }

    public function notifyStudents(Request $request, Event $event)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $attendeeCount = $event->registrations()->count();

        if ($attendeeCount === 0) {
            return back()->with('error', 'There are no students to notify for this event.');
        }

        // SAVE THE NOTIFICATION TO THE DATABASE
        \App\Models\EventNotification::create([
            'event_id' => $event->id,
            'message' => $request->message
        ]);

        return back()->with('success', 'Notification was successfully posted to ' . $attendeeCount . ' student dashboards!');
    }
}
