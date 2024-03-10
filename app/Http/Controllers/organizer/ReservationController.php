<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $organizer = $user->organizer;
        $events = $organizer->events()->with('reservations')->get();

        return view('organizer.reservations.index', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Reservation $reservation)
    {
        return view('organizer.reservations.edit', compact('event', 'reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($request->all());

        return redirect()->route('organizer.reservations.index')->with('success', 'Reservation status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('organizer.reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
