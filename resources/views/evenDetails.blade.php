@extends('layouts.index')

@section('events')
    <div class="max-w-4xl mx-auto my-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>
            <p class="text-gray-600 mb-4">{{ $event->description }}</p>
            <p class="text-gray-600 mb-4">Date: {{ $event->date }}</p>
            <p class="text-gray-600 mb-4">Category: {{ $event->category->name }}</p>
            <p class="text-gray-600 mb-4">Organizer: {{ $event->organizer->user->name }}</p>
            <img src="{{ $event->getFirstMediaUrl('event_images', 'thumb') }}" alt="{{ $event->title }}" class="mb-4">

            @if(auth()->check())
                @php
                    $reservation = $event->reservations()->where('user_id', auth()->user()->id)->first();
                @endphp
                @if(!$reservation)
                    <form id="reservationForm{{ $event->id }}" action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="button" onclick="confirmReservation({{ $event->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reserve</button>
                    </form>
                @else
                    <p class="bg-green-500 text-white font-bold py-2 px-4 rounded">You've already reserved this event</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login to Reserve</a>
            @endif
        </div>
    </div>
@endsection
