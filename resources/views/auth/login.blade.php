<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evento</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 </head>
 <body>
    <main class="mx-auto flex min-h-screen w-full items-center justify-center bg-gray-900 text-white">
        <section class="flex w-[30rem] flex-col space-y-10">
            <div class="text-center text-4xl font-medium">Log In</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                    <input name="email" type="text" placeholder="Email or Username" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"/>
                    @error('email')
                        <p class="text-size-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                    <input type="password" name="password" placeholder="Password" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"/>
                    @error('password')
                        <p class="text-size-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
        
                <button class="transform rounded-sm bg-indigo-600 p-2 font-bold duration-300 hover:bg-indigo-400">LOG IN</button>
            </form>
            <a href="{{ route('password.request') }}" class="transform text-center font-semibold text-gray-500 duration-300 hover:text-gray-300">FORGOT PASSWORD?</a>
    
            <p class="text-center text-lg">
                No account?
                <a href="{{ route('register') }}" class="font-medium text-indigo-500 underline-offset-4 hover:underline">Create One</a>
            </p>

        </section>
    </main>
    
 </body>
 </html>