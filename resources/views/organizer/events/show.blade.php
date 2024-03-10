@extends('layouts.dash')

@section('content')
<div class="min-h-screen flex flex-col p-8 sm:p-16 md:p-24 justify-center bg-white">
    <!-- Themes: blue, purple and teal -->
    <div data-theme="teal" class="mx-auto max-w-6xl">
        <h2 class="sr-only">Featured case study</h2>
        <section class="font-sans text-black">
            <div class="[ lg:flex lg:items-center ] [ fancy-corners fancy-corners--large fancy-corners--top-left fancy-corners--bottom-right ]">
                <div class="flex-shrink-0 self-stretch sm:flex-basis-40 md:flex-basis-50 xl:flex-basis-60">
                    <div class="h-full">
                        <article class="h-full">
                            <div class="h-full">
                                @if($event->getFirstMedia('event_images'))
                                    <img class="h-full object-cover" src="{{ $event->getFirstMedia('event_images')->getUrl() }}" alt="{{ $event->title }}" />
                                @else
                                    <!-- Placeholder image if no image is available -->
                                    <img class="h-full object-cover" src="{{ asset('placeholder-image.jpg') }}" alt="{{ $event->title }}" />
                                @endif
                            </div>
                        </article>
                    </div>
                </div>
                <div class="p-6 bg-grey">
                    <div class="leading-relaxed">
                        <h2 class="leading-tight text-4xl font-bold">{{ $event->title }}</h2>
                        <p class="mt-4">{{ $event->description }}</p>
                        <p class="mt-4">Date: {{ $event->date }}</p>
                        <p class="mt-4">Location: {{ $event->location }}</p>
                        <p class="mt-4">Available Seats: {{ $event->availableSeats }}</p>
                        <h2>Reservations</h2>
        @if ($event->reservations->isEmpty())
            <p>No reservations for this event yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event->reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ $reservation->status }}</td>
                            <td>
                                @if ($reservation->status === 'pending')
                                    <form method="POST" action="{{ route('reservations.accept', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>
                                    <form method="POST" action="{{ route('reservations.refuse', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Refuse</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
                        <p><a class="mt-4 button button--secondary" href="https://inviqa.com/cxcon-experience-transformation">Explore this event</a></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
