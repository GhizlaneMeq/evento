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
        $events = Event::with('organizer', 'category')
            ->where('status', 'confirmed')
            ->paginate(6);

        return view('welcome', compact('events', 'categories'));
    }


   
public function search(Request $request)
{
    $categories = Category::all();
    $category = $request->input('category');
    $searchQuery = $request->input('search_query');
    $dateFilter = $request->input('date_filter');


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

    $events = $eventsQuery->paginate(10);

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
