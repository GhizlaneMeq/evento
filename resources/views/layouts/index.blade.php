<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    @vite('resources/css/app.js')
</head>

{{--

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
        <div class="relative h-screen w-full">
            <img src="{{asset('images/hero.jpeg')}}" alt="Background Image"
                class="absolute inset-0 w-full h-full object-cover filter blur-sm">
            <div class="absolute inset-0 bg-black bg-opacity-0"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="flex p-10">
                    <div class="w-max">
                        <h1
                            class="animate-typing overflow-hidden whitespace-nowrap border-r-4 border-r-white pr-5 text-5xl text-white font-bold">
                            Discover, Reserve, Experience: Your Gateway to Unforgettable Events with Evento
                        </h1>
                    </div>
                </div>
                <p class="text-xl text-white mt-4">This is a sample text</p>

            </div>
        </div>

        @yield('events')


    </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body> --}}


<body class="bg-gradient-to-br from-gray-900 to-black">
    <div class="text-gray-300 container mx-auto p-8 overflow-hidden md:rounded-lg md:p-10 lg:p-12">
        <nav class="">
            <div class="max-w-screen-xl flex flex-wrap font-serif items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse font-serif text-3xl font-medium">
                    <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Logo">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Evento</span>
                </a>
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    @auth
    
                    <button type="button"
                        class="flex tex rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
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
                        class="self-start px-3 py-2 leading-none text-gray-200 border border-gray-800 rounded-lg focus:outline-none focus:shadow-outline bg-gradient-to-b hover:from-indigo-500 from-gray-900 to-black">Login</a>
                    <a href="{{ route('register') }}"
                        class="self-start px-3 py-2 leading-none text-gray-200 border border-gray-800 rounded-lg focus:outline-none focus:shadow-outline bg-gradient-to-b hover:from-indigo-500 from-gray-900 to-black">Register</a>
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
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                        <li>
                            <a href="/"
                                class="block py-2 px-3 bg-transparent text-blue-700 "
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#events"
                                class="block py-2 px-3 bg-transparent text-white ">Events</a>
                        </li>
                        <li>
                            <a href="#services"
                                class="block py-2 px-3 bg-transparent text-white ">Services</a>
                        </li>
                        <li>
                            <a href="#FAQs"
                                class="block py-2 px-3 bg-transparent text-white ">FAQs</a>
                        </li>
    
                    </ul>
                </div>
            </div>
        </nav>

        <div class="h-32 md:h-40"></div>


        <div class=" inset-0 flex flex-col">
            <div class="flex">

                <p
                    class=" animate-typing overflow-hidden  whitespace-nowrap border-r-4 border-r-white pr-5 text-5xl text-white font-bold font-sans ">
                    Experience the Future of Event Management with Evento</p>

            </div>

        </div>
        <div class="h-10"></div>
        <p class="max-w-2xl font-serif text-xl text-gray-400 md:text-2xl">
            Evento: Where Events Begin, Reservations Made Easy. Experience Unforgettable Moments with Us."
        </p>


        <div class="h-32 md:h-40"></div>

        <div id="services" class="grid gap-8 md:grid-cols-2">
            <div class="flex flex-col justify-center">
                <p
                    class="self-start inline font-sans text-xl font-medium text-transparent bg-clip-text bg-gradient-to-br from-green-400 to-green-600">
                    Our Services: Streamlining Event Management for You
                </p>
                <h2 class="text-4xl font-bold">Effortless Solutions for Every Step of Your Event Journe</h2>
                <div class="h-6"></div>
                <p class="font-serif text-xl text-gray-400 md:pr-10">
                    At Evento, we offer a comprehensive range of services tailored to simplify
                    every aspect of event management. From seamless reservation systems
                    to detailed event analytics, we're here to ensure your events are nothing short of spectacular
                </p>
                <div class="h-8"></div>
                <div class="grid grid-cols-2 gap-4 pt-8 border-t border-gray-800">
                    <div>
                        <p class="font-semibold text-gray-400">Seamless Reservation System</p>
                        <div class="h-4"></div>
                        <p class="font-serif text-gray-400">
                            With our Seamless Reservation System,
                            Evento makes booking your spot at any event a breeze.
                            Say goodbye to long queues and complicated booking processes
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-400">Comprehensive Event Analytics</p>
                        <div class="h-4"></div>
                        <p class="font-serif text-gray-400">
                            Evento's Comprehensive Event Analytics service provides
                            valuable insights into the performance and success of your events.
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <div class="-mr-24 rounded-lg md:rounded-l-full bg-gradient-to-br from-gray-900 to-black h-96"></div>
            </div>
        </div>

        <div class="h-32 md:h-40"></div>
        @yield('search')
        <div class="h-32 md:h-40"></div>

        <div class="grid gap-4 md:grid-cols-3">
            @yield('events')
        </div>

        <div class="h-40"></div>

        <div class="grid gap-8 md:grid-cols-3">
            <div class="flex flex-col justify-center md:col-span-2">
                <p
                    class="self-start inline font-sans text-xl font-medium text-transparent bg-clip-text bg-gradient-to-br from-teal-400 to-teal-600">
                    Event Planning Made Effortless
                </p>
                <h2 class="text-4xl font-bold">Discover the Ease of Seamless Event Management with Evento</h2>
                <div class="h-6"></div>
                <p class="font-serif text-xl text-gray-400 md:pr-10">
                    Welcome to Evento, your one-stop solution for effortless event planning.
                    Whether you're organizing a corporate conference, a music festival,
                    or a community workshop, Evento streamlines every step of the process
                </p>
                <div class="h-8"></div>
                <div id="FAQs" class="grid gap-6 pt-8 border-t border-gray-800 lg:grid-cols-3">
                    <details>
                        <summary class="font-semibold text-gray-400">How do I create an account on Evento?</summary>
                        <div class="h-4"></div>
                        <p class="font-serif text-gray-400">
                            Creating an account on Evento is simple! Just click on the "Sign Up"
                            button at the top right corner of the homepage. Fill in your name,
                            email address, and choose a secure password. Once done,
                            you're ready to explore and book events hassle-fre
                        </p>
                    </details>
                    <details>
                        <summary class="font-semibold text-gray-400">Can I cancel my event reservation?</summary>
                        <div class="h-4"></div>
                        <p class="font-serif text-gray-400">
                            Yes, you can cancel your event reservation through your Evento account.
                            Simply navigate to your bookings, locate the event you wish to cancel,
                            and follow the cancellation prompts. Please note that cancellation policies may vary
                            depending on the event organizer, so be sure to check the terms and conditions before
                            canceling.
                        </p>
                    </details>
                    <details>
                        <summary class="font-semibold text-gray-400">What should I do if I encounter an issue during the
                            event?</summary>
                        <div class="h-4"></div>
                        <p class="font-serif text-gray-400">
                            If you encounter any issues or require assistance
                            while attending an event, Evento is here to help. Simply reach out to
                            our dedicated support team by clicking on the "Support"
                            tab located on the Evento homepage. Our team is available
                            around the clock to address any concerns or technical difficulties you may
                            encounter. Your satisfaction and seamless event experience are our top priorities.
                        </p>
                    </details>
                </div>
            </div>
            <div>
                <div class="-mr-24 rounded-lg md:rounded-l-full bg-gradient-to-br from-gray-900 to-black h-96"></div>
            </div>
        </div>

        <div class="h-10 md:h-40"></div>

        <div class="grid gap-4 md:grid-cols-4">
            <ul class="space-y-1 text-gray-400">
                <li class="pb-4 font-serif text-gray-400">Social networks</li>
                <li>
                    <a href="https://twitter.com/victormustar" class="hover:underline">Twitter</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Linkedin</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Facebook</a>
                </li>
            </ul>
            <ul class="space-y-1 text-gray-400">
                <li class="pb-4 font-serif text-gray-400">Locations</li>
                <li>
                    <a href="#" class="hover:underline">Paris</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">New York</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">London</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Singapour</a>
                </li>
            </ul>
            <ul class="space-y-1 text-gray-400">
                <li class="pb-4 font-serif text-gray-400">Company</li>
                <li>
                    <a href="#" class="hover:underline">The team</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">About us</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Our vision</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Join us</a>
                </li>
            </ul>
            <ul class="space-y-1 text-gray-400">
                <li class="pb-4 font-serif text-gray-400">Join</li>
                <li>
                    <a href=""
                        class="self-start px-3 py-2 leading-none text-gray-200 border border-gray-800 rounded-lg focus:outline-none focus:shadow-outline bg-gradient-to-b hover:from-indigo-500 from-gray-900 to-black">
                        Login
                    </a>
                </li>
            </ul>
        </div>
        <div class="h-12"></div>
    </div>
    @yield('modal')
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>