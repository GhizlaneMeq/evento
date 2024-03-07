<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Evento</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @auth

                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
                </button>

                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email
                            }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Log
                                    out</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else

                <a href="{{ route('login') }}"
                    class="me-9 px-8 py-3 font-semibold border rounded  border-blue-700 dark:text-gray-100">Login</a>
                <a href="{{ route('register') }}"
                    class="px-8 py-3 font-semibold border rounded  border-blue-700 dark:text-gray-100">Register</a>
                @endauth

                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="/"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Events</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>  
        <div class="container mx-auto flex flex-wrap py-6">
            <aside class="w-1/4 bg-gray-100 p-6">
                <form action="{{ route('events.search') }}" method="get">
                    @csrf
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" name="title" placeholder="Rechercher un événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute right-0 top-0 mt-3 mr-4 h-6 w-6 text-gray-400">
                                <path fill-rule="evenodd" d="M9 0a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 2a7 7 0 1 1 0 14A7 7 0 0 1 9 2zm3.293 5.293a1 1 0 0 0-1.414-1.414L9 8.586l-1.879-1.88a1 1 0 1 0-1.414 1.414L7.586 10 5.707 11.879a1 1 0 1 0 1.414 1.414L9 11.414l1.879 1.88a1 1 0 0 0 1.414-1.414L10.414 10l1.879-1.879z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <button type="submit">search</button>
                    </div>
                    <div class="mb-6">
                        <select name="category" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                            <option value="" disabled selected>Filtrer par catégorie</option>
                            <!-- Add categories dynamically from backend -->
                            <option value="music">Musique</option>
                            <option value="sports">Sports</option>
                            <option value="arts">Arts</option>
                            <!-- Add more options as needed -->
                        </select>
                        <select name="organizer" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                            <option value="" disabled selected>Filtrer par organisateur</option>
                            <!-- Add organizers dynamically from backend -->
                            <option value="organizer1">Organisateur 1</option>
                            <option value="organizer2">Organisateur 2</option>
                            <option value="organizer3">Organisateur 3</option>
                            <!-- Add more options as needed -->
                        </select>
                        <input type="date" name="event_date" placeholder="Date de l'événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                        <input type="text" name="location" placeholder="Lieu de l'événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Rechercher
                    </button>
                </form>
            </aside>
            
            @yield('events')
            <aside class="w-1/4 flex flex-col items-center px-3">
                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <p class="text-xl font-semibold pb-5">About Us</p>
                    <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio
                        sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                    <a href="#"
                        class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                        Get to know us
                    </a>
                </div>

                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <p class="text-xl font-semibold pb-5">Instagram</p>
                    <div class="grid grid-cols-3 gap-3">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                        <img class="hover:opacity-75"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
                    </div>
                    <a href="#"
                        class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                        <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                    </a>
                </div>
            </aside>
            
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>



