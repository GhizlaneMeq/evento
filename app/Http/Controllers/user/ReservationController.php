<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->reservations;
        return view('user.reservations', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::findOrFail($request->event_id);

        if ($event->reservation_method === 'manual') {
            $reservation = Reservation::create([
                'event_id' => $event->id,
                'user_id' => auth()->id(),
                'status' => 'pending',
            ]);
            return response()->json(['success' => true, 'message' => 'Reservation pending organizer confirmation']);
        }

        $reservation = Reservation::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'status' => 'confirmed', 
        ]);
        
        $event->takenSeats++;
        $event->save();

        $pdf = FacadePdf::loadView('ticketPdf', compact('reservation'));
        $pdf->save(storage_path('ticket' . $reservation->id . '.pdf'));

        return response()->download(storage_path('ticket' . $reservation->id . '.pdf'))->deleteFileAfterSend(true);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            // Add validation rules for updating reservations here
        ]);

        $reservation->update($request->all());

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation deleted successfully');
    }
}
