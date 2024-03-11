<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        $organizers = Organizer::withCount(['events', 'events.reservations'])->get();

        $organizerStatistics = [];
        foreach ($organizers as $organizer) {
            $organizerStatistics[$organizer->name] = [
                'total_events' => $organizer->events_count,
                'total_reservations' => $organizer->events->sum('reservations_count'),
                'total_attendees' => $organizer->events->sum(function ($event) {
                    return $event->reservations->sum('attendees');
                }),
                'average_attendees_per_event' => $organizer->events->avg(function ($event) {
                    return $event->reservations->avg('attendees');
                }),
            ];
        }

        return view('organizer.statistics', compact('organizerStatistics'));
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
