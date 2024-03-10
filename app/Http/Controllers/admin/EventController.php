<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10); 
        return view('admin.event.display', compact('events'));
    }

    public function updateStatus(Request $request, Event $event)
    {
        //dd($request->all());
        $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);

        $event->update(['status' => $request->status]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event status updated successfully.');
    }
}
