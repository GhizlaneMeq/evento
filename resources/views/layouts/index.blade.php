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
                <div class="mb-6">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute right-0 top-0 mt-3 mr-4 h-6 w-6 text-gray-400">
                            <path fill-rule="evenodd" d="M9 0a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 2a7 7 0 1 1 0 14A7 7 0 0 1 9 2zm3.293 5.293a1 1 0 0 0-1.414-1.414L9 8.586l-1.879-1.88a1 1 0 1 0-1.414 1.414L7.586 10 5.707 11.879a1 1 0 1 0 1.414 1.414L9 11.414l1.879 1.88a1 1 0 0 0 1.414-1.414L10.414 10l1.879-1.879z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mb-6">
                    <select class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                        <option value="" disabled selected>Filtrer par catégorie</option>
                        <!-- Add categories dynamically from backend -->
                        <option value="music">Musique</option>
                        <option value="sports">Sports</option>
                        <option value="arts">Arts</option>
                        <!-- Add more options as needed -->
                    </select>
                    <select class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                        <option value="" disabled selected>Filtrer par organisateur</option>
                        <!-- Add organizers dynamically from backend -->
                        <option value="organizer1">Organisateur 1</option>
                        <option value="organizer2">Organisateur 2</option>
                        <option value="organizer3">Organisateur 3</option>
                        <!-- Add more options as needed -->
                    </select>
                    <input type="date" placeholder="Date de l'événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 mb-4">
                    <input type="text" placeholder="Lieu de l'événement" class="w-full py-2 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
                </div>
            </aside>
            <section class=" w-2/4 flex flex-col items-center px-3">

                <div
                    class="flex flex-col max-w-lg p-6 space-y-6 overflow-hidden rounded-lg shadow-md dark:bg-gray-900 dark:text-gray-100">
                    <div class="flex space-x-4">
                        <img alt="" src="https://source.unsplash.com/100x100/?portrait"
                            class="object-cover w-12 h-12 rounded-full shadow dark:bg-gray-500">
                        <div class="flex flex-col space-y-1">
                            <a rel="noopener noreferrer" href="#" class="text-sm font-semibold">Leroy Jenkins</a>
                            <span class="text-xs dark:text-gray-400">4 hours ago</span>
                        </div>
                    </div>
                    <div>
                        <img src="https://source.unsplash.com/random/100x100/?5" alt=""
                            class="object-cover w-full mb-4 h-60 sm:h-96 dark:bg-gray-500">
                        <h2 class="mb-1 text-xl font-semibold">Nam cu platonem posidonium sanctus debitis te</h2>
                        <p class="text-sm dark:text-gray-400">Eu qualisque aliquando mel, id lorem detraxit nec, ad elit
                            minimum pri. Illum ipsum detracto ne cum. Mundi nemore te ius, vim ad illud atqui
                            apeirian...</p>
                    </div>
                    <div class="flex flex-wrap justify-between">
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
                        <div class="flex space-x-2 text-sm dark:text-gray-400">
                            <button type="button" class="flex items-center p-1 space-x-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    aria-label="Number of comments" class="w-4 h-4 fill-current dark:text-blue-400">
                                    <path
                                        d="M448.205,392.507c30.519-27.2,47.8-63.455,47.8-101.078,0-39.984-18.718-77.378-52.707-105.3C410.218,158.963,366.432,144,320,144s-90.218,14.963-123.293,42.131C162.718,214.051,144,251.445,144,291.429s18.718,77.378,52.707,105.3c33.075,27.168,76.861,42.13,123.293,42.13,6.187,0,12.412-.273,18.585-.816l10.546,9.141A199.849,199.849,0,0,0,480,496h16V461.943l-4.686-4.685A199.17,199.17,0,0,1,448.205,392.507ZM370.089,423l-21.161-18.341-7.056.865A180.275,180.275,0,0,1,320,406.857c-79.4,0-144-51.781-144-115.428S240.6,176,320,176s144,51.781,144,115.429c0,31.71-15.82,61.314-44.546,83.358l-9.215,7.071,4.252,12.035a231.287,231.287,0,0,0,37.882,67.817A167.839,167.839,0,0,1,370.089,423Z">
                                    </path>
                                    <path
                                        d="M60.185,317.476a220.491,220.491,0,0,0,34.808-63.023l4.22-11.975-9.207-7.066C62.918,214.626,48,186.728,48,156.857,48,96.833,109.009,48,184,48c55.168,0,102.767,26.43,124.077,64.3,3.957-.192,7.931-.3,11.923-.3q12.027,0,23.834,1.167c-8.235-21.335-22.537-40.811-42.2-56.961C270.072,30.279,228.3,16,184,16S97.928,30.279,66.364,56.206C33.886,82.885,16,118.63,16,156.857c0,35.8,16.352,70.295,45.25,96.243a188.4,188.4,0,0,1-40.563,60.729L16,318.515V352H32a190.643,190.643,0,0,0,85.231-20.125,157.3,157.3,0,0,1-5.071-33.645A158.729,158.729,0,0,1,60.185,317.476Z">
                                    </path>
                                </svg>
                                <span>30</span>
                            </button>
                            <button type="button" class="flex items-center p-1 space-x-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    aria-label="Number of likes" class="w-4 h-4 fill-current dark:text-blue-400">
                                    <path
                                        d="M126.638,202.672H51.986a24.692,24.692,0,0,0-24.242,19.434,487.088,487.088,0,0,0-1.466,206.535l1.5,7.189a24.94,24.94,0,0,0,24.318,19.78h74.547a24.866,24.866,0,0,0,24.837-24.838V227.509A24.865,24.865,0,0,0,126.638,202.672ZM119.475,423.61H57.916l-.309-1.487a455.085,455.085,0,0,1,.158-187.451h61.71Z">
                                    </path>
                                    <path
                                        d="M494.459,277.284l-22.09-58.906a24.315,24.315,0,0,0-22.662-15.706H332V173.137l9.573-21.2A88.117,88.117,0,0,0,296.772,35.025a24.3,24.3,0,0,0-31.767,12.1L184.693,222.937V248h23.731L290.7,67.882a56.141,56.141,0,0,1,21.711,70.885l-10.991,24.341L300,169.692v48.98l16,16H444.3L464,287.2v9.272L396.012,415.962H271.07l-86.377-50.67v37.1L256.7,444.633a24.222,24.222,0,0,0,12.25,3.329h131.6a24.246,24.246,0,0,0,21.035-12.234L492.835,310.5A24.26,24.26,0,0,0,496,298.531V285.783A24.144,24.144,0,0,0,494.459,277.284Z">
                                    </path>
                                </svg>
                                <span>283</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
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



