<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('organizer.organization', 'category')
            ->where('status', 'confirmed')
            ->paginate(10);

        return view('welcome', compact('events'));
    }


    public function search(Request $request)
    {
        // Retrieve search criteria from the request
        $title = $request->input('title');
        $category = $request->input('category');
        $organizer = $request->input('organizer');
        $eventDate = $request->input('event_date');
        $location = $request->input('location');

        // Perform database query based on search criteria
        $events = Event::query()
            ->when($title, function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($organizer, function ($query) use ($organizer) {
                $query->where('organizer', $organizer);
            })
            ->when($eventDate, function ($query) use ($eventDate) {
                $query->whereDate('event_date', $eventDate);
            })
            ->when($location, function ($query) use ($location) {
                $query->where('location', 'like', '%' . $location . '%');
            })
            ->get();

        // Pass the search results to the view
        return response()->json(['events' => $events], 302)
                         ->header('Location', '/');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
