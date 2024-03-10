{{-- @extends('layouts.index')

@section('events')

<div class="max-w-7xl mx-auto my-8 px-2">

    <div class="flex justify-center text-2xl md:text-3xl font-bold">
        Related Tools
    </div>
    <form id="searchForm" action="{{ route('events.search') }}" method="GET">
        <div class="flex justify-center my-4">
            <select name="category" class="rounded-md border border-gray-300 py-2 px-4 ml-2">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input type="text" name="search_query" id="searchQuery" class="rounded-md border border-gray-300 py-2 px-4"
                placeholder="Search by Title, Organizer, or Date (e.g., 'Workshop', 'John Doe', '2024-03-10')">
            <select name="date_filter" class="rounded-md border border-gray-300 py-2 px-4 ml-2">
                <option value="">All Dates</option>
                <option value="{{ now()->toDateString() }}">Today</option>
                <!-- Add more date options as needed -->
            </select>
            <button type="button" id="searchButton"
                class="rounded-md bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2">Search</button>
        </div>
    </form>



    <ul id="eventsList" class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 p-2 xl:p-5">
        @if ($events->isEmpty())
        <p>there are no events yet</p>
        @else
        @foreach($events as $event)
        <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-teal-400">


            <a class="relative" href="{{ route('events.show', $event->id) }}">
                <img class="rounded relative w-full object-cover aspect-video"
                    src="{{ $event->getFirstMediaUrl('event_images', 'thumb') }}" alt="{{ $event->title }}"
                    loading="lazy">
            </a>
            <div class="flex flex-col max-w-lg  overflow-hidden rounded-lg shadow-md dark:bg-gray-900 dark:text-gray-100">
                <div class="flex ">
                    <img alt="" src="{{ $event->organizer->user->getFirstMediaUrl('profile_picture') }}"
                        class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                    <div class="flex flex-col">
                        <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">{{
                            $event->organizer->user->name
                            }}</a>
                        <span class="text-xs dark:text-gray-400">{{ $event->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="flex flex-col justify-beetween gap-3 px-4 py-2">
                    <a href="/tool/writey-ai"
                        class="flex justify-center items-center text-xl font-semibold text-teal-700 hover:text-teal-800 two-lines text-ellipsis">
                        <span>{{ $event->title}}</span>
                    </a>

                    <p class="text-gray-600 two-lines">{{ $event->description}}</p>

                    <ul class="flex flex-wrap items-center justify-start text-sm gap-2">
                        <li title="Pricing type"
                            class="flex items-center cursor-pointer gap-0.5 bg-gray-100 text-black px-2 py-0.5 rounded-full">

                            <span>{{ $event->category->name}}</span>
                        </li>

                    </ul>
                </div>
                <div class="flex flex-wrap justify-between">
                    @if(auth()->check())
                    @php
                    $reservation = $event->reservations()->where('user_id', auth()->user()->id)->first();
                    @endphp
                    @if(!$reservation)
                    <form id="reservationForm{{$event->id}}" action="{{ route('user.reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <button type="button" onclick="confirmReservation({{$event->id}})"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Reserve
                        </button>
                    </form>
                    @else
                    <p class="bg-white text-green-500 px-4 py-2 rounded">You've Already reserved</p>
                    @endif
                    @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Reserve
                    </a>
                    @endif


                    <div class="space-x-2">
                        <button aria-label="Share this post" type="button" class="p-2 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="w-4 h-4 fill-current dark:text-blue-400">
                                <path
                                    d="M404,344a75.9,75.9,0,0,0-60.208,29.7L179.869,280.664a75.693,75.693,0,0,0,0-49.328L343.792,138.3a75.937,75.937,0,1,0-13.776-28.976L163.3,203.946a76,76,0,1,0,0,104.108l166.717,94.623A75.991,75.991,0,1,0,404,344Zm0-296a44,44,0,1,1-44,44A44.049,44.049,0,0,1,404,48ZM108,300a44,44,0,1,1,44-44A44.049,44.049,0,0,1,108,300ZM404,464a44,44,0,1,1,44-44A44.049,44.049,0,0,1,404,464Z">
                                </path>
                            </svg>
                        </button>
                        <button aria-label="Bookmark this post" type="button" class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="w-4 h-4 fill-current dark:text-blue-400">
                                <path
                                    d="M424,496H388.75L256.008,381.19,123.467,496H88V16H424ZM120,48V456.667l135.992-117.8L392,456.5V48Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

        </li>
        @endforeach
        @if ($events->hasPages())
        <div class="flex justify-center">
            {{ $events->links() }}
        </div>
        @endif
        @endif




    </ul>

</div>
<script>
     function confirmReservation(eventId) {
        if (confirm("Are you sure you want to reserve this event?")) {
            const form = document.getElementById('reservationForm' + eventId);
            const actionUrl = '{{ route("user.reservation.store") }}';
            fetch(actionUrl, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Reservation has been made successfully!");
                        // Redirect or perform further actions as needed
                    } else {
                        alert("Failed to make reservation. Please try again later.");
                    }
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                    alert("An error occurred while processing your reservation.");
                });
        }
    }


    document.addEventListener('DOMContentLoaded', function () {
        const searchButton = document.getElementById('searchButton');
        const searchQueryInput = document.getElementById('searchQuery');
        const eventsList = document.getElementById('eventsList');

        searchButton.addEventListener('click', function () {
            const searchParams = new URLSearchParams({
                category: document.querySelector('select[name="category"]').value,
                search_query: searchQueryInput.value,
                date_filter: document.querySelector('select[name="date_filter"]').value
            }).toString();
            const searchUrl = "{{ route('events.search') }}?" + searchParams;

            fetch(searchUrl)
                .then(response => response.json())
                .then(data => {
                    // Clear the current list of events
                    eventsList.innerHTML = '';

                    // Add the new events to the list
                    data.events.forEach(event => {
                        const eventHtml = `
                        <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-teal-400">
                            <a href="{{ route('organizer.events.show', $event->id) }}" class="relative">
                                <img class="rounded w-full object-cover aspect-video" src="{{ $event->getFirstMediaUrl('event_images', 'thumb') }}" alt="{{ $event->title }}" loading="lazy">
                            </a>
                            <div class="flex flex-col max-w-lg overflow-hidden rounded-lg shadow-md dark:bg-gray-900 dark:text-gray-100">
                                <div class="flex">
                                    <img alt="" src="{{ $event->organizer->user->getFirstMediaUrl('profile_picture') }}" class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                                    <div class="flex flex-col">
                                        <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">{{ $event->organizer->user->name }}</a>
                                        <span class="text-xs dark:text-gray-400">{{ $event->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col justify-between gap-3 px-4 py-2">
                                    <a href="{{ route('organizer.events.show', $event->id) }}" class="flex justify-center items-center text-xl font-semibold text-teal-700 hover:text-teal-800 two-lines text-ellipsis">
                                        <span>{{ $event->title }}</span>
                                    </a>

                                    <p class="text-gray-600 two-lines">{{ $event->description }}</p>

                                    <ul class="flex flex-wrap items-center justify-start text-sm gap-2">
                                        <li title="Pricing type" class="flex items-center cursor-pointer gap-0.5 bg-gray-100 text-black px-2 py-0.5 rounded-full">
                                            <span>{{ $event->category->name }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flex flex-wrap justify-between">
                                    @if(auth()->check())
                                        @php
                                            $reservation = $event->reservations()->where('user_id', auth()->user()->id)->first();
                                        @endphp
                                        @if(!$reservation)
                                            <form id="reservationForm{{ $event->id }}" action="{{ route('reservations.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <button type="button" onclick="confirmReservation({{ $event->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Reserve
                                                </button>
                                            </form>
                                        @else
                                            <p class="bg-white text-green-500 px-4 py-2 rounded">You've Already reserved</p>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Reserve
                                        </a>
                                    @endif

                                    <div class="space-x-2">
                                        <button aria-label="Share this post" type="button" class="p-2 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current dark:text-blue-400">
                                                <path d="M404,344a75.9,75.9,0,0,0-60.208,29.7L179.869,280.664a75.693,75.693,0,0,0,0-49.328L343.792,138.3a75.937,75.937,0,1,0-13.776-28.976L163.3,203.946a76,76,0,1,0,0,104.108l166.717,94.623A75.991,75.991,0,1,0,404,344Zm0-296a44,44,0,1,1-44,44A44.049,44.049,0,0,1,404,48ZM108,300a44,44,0,1,1,44-44A44.049,44.049,0,0,1,108,300ZM404,464a44,44,0,1,1,44-44A44.049,44.049,0,0,1,404,464Z"></path>
                                            </svg>
                                        </button>
                                        <button aria-label="Bookmark this post" type="button" class="p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current dark:text-blue-400">
                                                <path d="M424,496H388.75L256.008,381.19,123.467,496H88V16H424ZM120,48V456.667l135.992-117.8L392,456.5V48Z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                      `;
                        eventsList.insertAdjacentHTML('beforeend', eventHtml);
                    });

                    // Handle case where no events are found
                    if (data.events.length === 0) {
                        const noEventsHtml = `<p>No events found</p>`;
                        eventsList.insertAdjacentHTML('beforeend', noEventsHtml);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

@endsection
 --}}







 @extends('layouts.index')

 @section('events')
 
    @if ($events->isEmpty())
        <p>there are no events yet</p>
    @else
        @foreach($events as $event)
            <div class="flex-col p-8 py-16 rounded-lg shadow-2xl md:p-12 bg-gradient-to-b from-gray-900 to-black">
                <a class="relative" href="{{ route('events.show', $event->id) }}">
                    @dd( $event->getMedia('event_images'))
                    @if ($event->getMedia('event_images')->isNotEmpty())
                        <img class="rounded relative w-full object-cover aspect-video" src="{{ $event->getMedia('event_images')->first()->getUrl('thumb')}}" alt="{{ $event->title }}" loading="lazy">
                    @else
                        <img class="rounded relative w-full object-cover aspect-video" src="{{ asset('images/default-event-image.jpg') }}" alt="{{ $event->title }}" loading="lazy">
                    @endif
                    </a>
                <div class="flex ">
                    <img alt="" src="{{ $event->organizer->user->getFirstMediaUrl('profile_picture') }}" class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                    <div class="flex flex-col">
                        <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">{{ $event->organizer->user->name}}</a>
                        <span class="text-xs dark:text-gray-400">{{ $event->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- <div class="flex flex-col justify-beetween gap-3 px-4 py-2">
                    <a href="/tool/writey-ai"
                        class="flex justify-center items-center text-xl font-semibold text-teal-700 hover:text-teal-800 two-lines text-ellipsis">
                        <span>{{ $event->title}}</span>
                    </a>

                    <p class="text-gray-600 two-lines">{{ $event->description}}</p>

                    <ul class="flex flex-wrap items-center justify-start text-sm gap-2">
                        <li title="Pricing type"
                            class="flex items-center cursor-pointer gap-0.5 bg-gray-100 text-black px-2 py-0.5 rounded-full">

                            <span>{{ $event->category->name}}</span>
                        </li>

                    </ul>
                </div>
                <div class="flex flex-wrap justify-between">
                    @if(auth()->check())
                    @php
                    $reservation = $event->reservations()->where('user_id', auth()->user()->id)->first();
                    @endphp
                    @if(!$reservation)
                    <form id="reservationForm{{$event->id}}" action="{{ route('user.reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <button type="button" onclick="confirmReservation({{$event->id}})"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Reserve
                        </button>
                    </form>
                    @else
                    <p class="bg-white text-green-500 px-4 py-2 rounded">You've Already reserved</p>
                    @endif
                    @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Reserve
                    </a>
                    @endif


                    <div class="space-x-2">
                        <button aria-label="Share this post" type="button" class="p-2 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="w-4 h-4 fill-current dark:text-blue-400">
                                <path
                                    d="M404,344a75.9,75.9,0,0,0-60.208,29.7L179.869,280.664a75.693,75.693,0,0,0,0-49.328L343.792,138.3a75.937,75.937,0,1,0-13.776-28.976L163.3,203.946a76,76,0,1,0,0,104.108l166.717,94.623A75.991,75.991,0,1,0,404,344Zm0-296a44,44,0,1,1-44,44A44.049,44.049,0,0,1,404,48ZM108,300a44,44,0,1,1,44-44A44.049,44.049,0,0,1,108,300ZM404,464a44,44,0,1,1,44-44A44.049,44.049,0,0,1,404,464Z">
                                </path>
                            </svg>
                        </button>
                        <button aria-label="Bookmark this post" type="button" class="p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="w-4 h-4 fill-current dark:text-blue-400">
                                <path
                                    d="M424,496H388.75L256.008,381.19,123.467,496H88V16H424ZM120,48V456.667l135.992-117.8L392,456.5V48Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div> --}}
                
            </div>
        @endforeach
        @if ($events->hasPages())
            <div class="flex justify-center">
                {{ $events->links() }}
            </div>
        @endif

    @endif
 @endsection