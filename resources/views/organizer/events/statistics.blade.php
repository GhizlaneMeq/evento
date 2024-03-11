@extends('layouts.dash') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Organizer Statistics</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($organizerStatistics as $organizerName => $stats)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">{{ $organizerName }}</h2>
                <ul>
                    <li>Total Events: {{ $stats['total_events'] }}</li>
                    <li>Total Reservations: {{ $stats['total_reservations'] }}</li>
                    <li>Total Attendees: {{ $stats['total_attendees'] }}</li>
                    <li>Average Attendees per Event: {{ $stats['average_attendees_per_event'] }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
