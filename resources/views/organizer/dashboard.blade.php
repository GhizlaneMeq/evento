@extends('layouts.dash')

@section('content')
<div class="mt-4">
    <div class="mb-4">
      <a href="{{ route('organizer.events.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Event</a>
  </div>
    @if ($events->isEmpty())
        <p class="text-gray-500">There are no events yet.</p>
    @else
    <ul role="list" class="space-y-4">
       
        @foreach($events as $event)

         <li class="bg-white px-4 py-6 shadow sm:rounded-lg sm:p-6">
            <article aria-labelledby="question-title-81614">
                <div>
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full"
                                src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                alt="">
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                <a href="#" class="hover:underline">{{ $user->name }}</a>
                            </p>
                            <p class="text-sm text-gray-500">
                                <a href="#" class="hover:underline">
                                    <time datetime="2020-12-09T11:43:00">Created {{ $event->created_at->diffForHumans() }}</time>
                                </a>
                            </p>
                        </div>
                        <div class="flex flex-shrink-0 self-center">
                            <div x-data="{ open: false }" @click.away="open = false"
                                class="relative inline-block text-left">
                                <button type="button"
                                    class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                    @click="open = !open" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open options</span>
                                    <svg class="h-5 w-5" x-description="Heroicon name: mini/ellipsis-vertical"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path
                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                        </path>
                                    </svg>
                                </button>

                                <div x-show="open"
                                    class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1" role="none">
                                        <a href="{{ route('organizer.events.show', $event->id) }}"
                                            class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100">
                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                x-description="Heroicon name: mini/star"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>show more details</span>
                                        </a>
                                        <a href="{{ route('organizer.events.edit', $event->id) }}"
                                            class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100">
                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                x-description="Heroicon name: mini/code-bracket"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M6.28 5.22a.75.75 0 010 1.06L2.56 10l3.72 3.72a.75.75 0 01-1.06 1.06L.97 10.53a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0zm7.44 0a.75.75 0 011.06 0l4.25 4.25a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06-1.06L17.44 10l-3.72-3.72a.75.75 0 010-1.06zM11.377 2.011a.75.75 0 01.612.867l-2.5 14.5a.75.75 0 01-1.478-.255l2.5-14.5a.75.75 0 01.866-.612z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>edit</span>
                                        </a>
                                        <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100">
                                                <svg class="mr-3 h-5 w-5 text-gray-400"
                                                    x-description="Heroicon name: mini/flag"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M3.5 2.75a.75.75 0 00-1.5 0v14.5a.75.75 0 001.5 0v-4.392l1.657-.348a6.449 6.449 0 014.271.572 7.948 7.948 0 005.965.524l2.078-.64A.75.75 0 0018 12.25v-8.5a.75.75 0 00-.904-.734l-2.38.501a7.25 7.25 0 01-4.186-.363l-.502-.2a8.75 8.75 0 00-5.053-.439l-1.475.31V2.75z">
                                                    </path>
                                                </svg>
                                                <span>delete</span>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 id="question-title-81614" class="mt-4 text-base font-medium text-gray-900"> {{$event->title}} </h2>
                </div>
                <div class="mt-2 space-y-4 text-sm text-gray-700">
                    <p>{{$event->description}}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
                    <p><strong>End Time:</strong> {{ $event->end_time }}</p>
                </div>
                <div class="mt-6 flex justify-between space-x-8">
                    <div class="flex space-x-6">
                        <span class="inline-flex items-center text-sm">
                            <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" x-description="Heroicon name: mini/hand-thumb-up"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path
                                        d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-900">29</span>
                                <span class="sr-only">likes</span>
                            </button>
                        </span>
                        
                        <span class="inline-flex items-center text-sm">
                            <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" x-description="Heroicon name: mini/eye"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                                    <path fill-rule="evenodd"
                                        d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium text-gray-900">2.7k</span>
                                <span class="sr-only">views</span>
                            </button>
                        </span>
                    </div>
                    <div class="flex text-sm">
                        <span class="inline-flex items-center text-sm">
                            <button type="button" class="inline-flex space-x-2 text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" x-description="Heroicon name: mini/share"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path
                                        d="M13 4.5a2.5 2.5 0 11.702 1.737L6.97 9.604a2.518 2.518 0 010 .792l6.733 3.367a2.5 2.5 0 11-.671 1.341l-6.733-3.367a2.5 2.5 0 110-3.475l6.733-3.366A2.52 2.52 0 0113 4.5z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-900">Share</span>
                            </button>
                        </span>
                    </div>
                </div>
            </article>
        </li> 
        
        @endforeach
    </ul>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        var isClickInside = document.getElementById('options-menu-0-button').contains(event.target);
        if (!isClickInside) {
            var menu = document.getElementById('options-menu-0');
            menu.style.display = 'none';
        }
    });
</script>
@endpush
