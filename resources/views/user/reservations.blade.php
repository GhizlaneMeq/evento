
@extends('layouts.index') 
@section('events')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Your Reservations</h1>

    @if($reservations->isEmpty())
        <p>You have not made any reservations yet.</p>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reservations as $reservation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->event->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->event->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->event->location }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
