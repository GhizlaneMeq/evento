<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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

    // Validate the request including the image field
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        // Include other fields you might have
    ]);

    // Merge the organizer_id into the request data
    $request->merge(['organizer_id' => $organizer->id]);

    // Store the image
    $path = $request->file('image')->store('images', 'public');

    // Create the event with the image path
    $event = Event::create(array_merge($request->except('image'), ['image' => $path]));

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
