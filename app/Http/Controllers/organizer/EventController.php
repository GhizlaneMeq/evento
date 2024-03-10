<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $organizer = $user->organizer;
        $events = $organizer->events;

        return view('organizer.dashboard', compact('events', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('organizer.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organizer = Organizer::where('user_id', auth()->id())->first();
        if (!$organizer) {
            return redirect()->back()->with('error', 'You are not authorized to create events.');
        }

        $request->merge(['organizer_id' => $organizer->id]);
        $event = Event::create($request->all());

        if ($request->hasFile('image')) {
            $imagePath = Storage::disk('event_images')->putFile('', $request->file('image'));
            $event->addMedia(storage_path('\app\\'.$imagePath))->toMediaCollection('event_images');
        }

        return redirect()->route('organizer.events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('reservations.user');
        return view('organizer.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('organizer.events.edit', compact('categories', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('organizer.events.index')->with('success', 'Event deleted successfully.');
    }
}
