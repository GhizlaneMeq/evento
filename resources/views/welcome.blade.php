@extends('layouts.index')

@section('events')
<section class="w-2/4 flex flex-col items-center px-3">
    <form id="searchForm" action="#" method="GET" class="mb-4">
        <input id="queryInput" type="text" name="query" placeholder="Search events..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md">
    </form>
    <div id="eventsContainer" class="flex flex-col max-w-lg p-6 space-y-6 overflow-hidden dark:text-gray-100">
        @foreach($events as $event)
        <div
            class="flex flex-col max-w-lg p-6 space-y-6 overflow-hidden rounded-lg shadow-md dark:bg-gray-900 dark:text-gray-100">
            <div class="flex space-x-4">
                <img alt="" src="https://source.unsplash.com/100x100/?portrait"
                    class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                <div class="flex flex-col space-y-1">
                    <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">{{ $event->organizer->user->name
                        }}</a>
                    <span class="text-xs dark:text-gray-400">{{ $event->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div>
                <img src="https://source.unsplash.com/random/100x100/?5" alt=""
                    class="object-cover w-full mb-4 h-60 sm:h-96 dark:bg-gray-500">
                <h2 class="mb-1 text-xl font-semibold">{{ $event->title }}</h2>
                <p class="text-sm dark:text-gray-400">{{ $event->description }}</p>
            </div>
            <div class="flex flex-wrap justify-between">
            </div>
            <div class="flex flex-wrap justify-between">
                @if(auth()->check())
                @php
                $reservation = $event->reservations()->where('user_id', auth()->user()->id)->first();
                @endphp
                @if(!$reservation)
                <form id="reservationForm{{$event->id}}" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <button type="button" onclick="confirmReservation({{$event->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
        </div>
        @endforeach
    </div>
    @if ($events->hasPages())
    <div class="flex justify-center">
        {{ $events->links() }}
    </div>
    @endif
</section>

<div class="relative bg-gray-50 px-6 pt-16 pb-20 lg:px-8 lg:pt-24 lg:pb-28">
    <div class="absolute inset-0">
      <div class="h-1/3 bg-white sm:h-2/3"></div>
    </div>
    <div class="relative mx-auto max-w-7xl">
      <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Column me neatly.</h2>
        <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">
          This is your life and it's ending one minute @ a time...</p>
      </div>
      <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
  
        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1679&amp;q=80" alt="">
          </div>
          <div class="flex flex-1 flex-col justify-between bg-white p-6">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <a href="#" class="hover:underline">Article</a>
              </p>
              <a href="#" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">Boost your conversion rate</p>
                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Architecto accusantium praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.</p>
              </a>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <a href="#">
                  <span class="sr-only">Roel Aufderehar</span>
                  <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="#" class="hover:underline">Roel Aufderehar</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time datetime="2020-03-16">Mar 16, 2020</time>
                  <span aria-hidden="true">·</span>
                  <span>6 min read</span>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1679&amp;q=80" alt="">
          </div>
          <div class="flex flex-1 flex-col justify-between bg-white p-6">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <a href="#" class="hover:underline">Video</a>
              </p>
              <a href="#" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">How to use search engine optimization to drive sales</p>
                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                  facilis asperiores porro quaerat doloribus, eveniet dolore. Adipisci tempora aut inventore optio animi.,
                  tempore temporibus quo laudantium.</p>
              </a>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <a href="#">
                  <span class="sr-only">Brenna Goyette</span>
                  <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="#" class="hover:underline">Brenna Goyette</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time datetime="2020-03-10">Mar 10, 2020</time>
                  <span aria-hidden="true">·</span>
                  <span>4 min read</span>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1492724441997-5dc865305da7?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1679&amp;q=80" alt="">
          </div>
          <div class="flex flex-1 flex-col justify-between bg-white p-6">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <a href="#" class="hover:underline">Case Study</a>
              </p>
              <a href="#" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">Improve your customer experience</p>
                <p class="mt-3 text-base text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint
                  harum rerum voluptatem quo recusandae magni placeat saepe molestiae, sed excepturi cumque corporis
                  perferendis hic.</p>
              </a>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <a href="#">
                  <span class="sr-only">Daniela Metz</span>
                  <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" alt="">
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="#" class="hover:underline">Daniela Metz</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time datetime="2020-02-12">Feb 12, 2020</time>
                  <span aria-hidden="true">·</span>
                  <span>11 min read</span>
                </div>
              </div>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  </div>

<script>
    function confirmReservation(eventId) {
    if (confirm("Are you sure you want to reserve this event?")) {
        const form = document.getElementById('reservationForm' + eventId);
        const actionUrl = '{{ route("reservations.store") }}'; 
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




    document.getElementById('searchForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const queryString = new URLSearchParams(formData).toString();
        const actionUrl = `${this.getAttribute('action')}?${queryString}`;
        fetch(actionUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                displaySearchResults(data.events);
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
    });

    function displaySearchResults(events) {
        const container = document.getElementById('eventsContainer');
        container.innerHTML = ''; // Clear previous results

        if (events.length === 0) {
            container.innerHTML = '<p>No events found</p>';
            return;
        }

        events.forEach(event => {
            const eventDiv = document.createElement('div');
            eventDiv.classList.add('flex', 'flex-col', 'max-w-lg', 'p-6', 'space-y-6', 'overflow-hidden', 'rounded-lg', 'shadow-md', 'dark:bg-gray-900', 'dark:text-gray-100');
            eventDiv.innerHTML = `
                <div class="flex space-x-4">
                    <img alt="" src="${event.organizer.user.profile_picture}" class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                    <div class="flex flex-col space-y-1">
                        <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">${event.organizer.user.name}</a>
                        <span class="text-xs dark:text-gray-400">${event.created_at}</span>
                    </div>
                </div>
                <div>
                    <img src="${event.image}" alt="" class="object-cover w-full mb-4 h-60 sm:h-96 dark:bg-gray-500">
                    <h2 class="mb-1 text-xl font-semibold">${event.title}</h2>
                    <p class="text-sm dark:text-gray-400">${event.description}</p>
                </div>
                <div class="flex flex-wrap justify-between">
                    <!-- Additional information here if needed -->
                </div>
                <div class="flex flex-wrap justify-between">
                    <div class="space-x-2">
                        <!-- Buttons here if needed -->
                    </div>
                </div>
            `;
            container.appendChild(eventDiv);
        });
    }
</script>
@endsection