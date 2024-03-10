<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories=Category::all();
        $events = Event::with('organizer.organization', 'category')
            ->where('status', 'confirmed')
            ->paginate(10);

        return view('welcome', compact('events', 'categories'));
    }


   /*  public function search(Request $request)
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
            $query->where('category_id', $category);
        })
        ->when($organizer, function ($query) use ($organizer) {
            $query->whereHas('organizer', function ($query) use ($organizer) {
                $query->where('name', 'like', '%' . $organizer . '%');
            });
        })
        ->when($eventDate, function ($query) use ($eventDate) {
            $query->whereDate('date', $eventDate);
        })
        ->when($location, function ($query) use ($location) {
            $query->where('location', 'like', '%' . $location . '%');
        })
        ->get();

    // Pass the search results to the view
    return response()->json(['events' => $events]);
}
 */
public function search(Request $request)
{
    $categories = Category::all();
    $category = $request->input('category');
    $searchQuery = $request->input('search_query');
    $dateFilter = $request->input('date_filter');

    // Query events
    $eventsQuery = Event::query()
        ->when($category, function ($query) use ($category) {
            $query->where('category_id', $category);
        })
        ->when($searchQuery, function ($query) use ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('organizer.user', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . $searchQuery . '%');
                    })
                    ->orWhereDate('date', $searchQuery);
            });
        })
        ->when($dateFilter, function ($query) use ($dateFilter) {
            $query->whereDate('date', $dateFilter);
        });

    // Paginate the results
    $events = $eventsQuery->paginate(10);

    // Pass $events and $categories to the view
    return view('welcome', compact('events', 'categories'));
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
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('evenDetails', compact('event'));
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
