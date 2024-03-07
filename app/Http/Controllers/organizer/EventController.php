<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(StoreEventRequest $request)
    {
        $organizer = Organizer::where('user_id', auth()->id())->first();
        if (!$organizer) {
            return redirect()->back()->with('error', 'You are not authorized to create events.');
        }

        $eventData = $request->validated();

        $eventData['organizer_id'] = $organizer->id;

        $event = new Event($eventData);

        if ($request->hasFile('image')) {
            $event->addMediaFromRequest('image')
                 ->toMediaCollection('event_images');
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
