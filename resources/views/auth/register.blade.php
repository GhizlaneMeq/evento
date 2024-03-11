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
        <div class="text-center text-4xl font-medium">Register</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                <input name="name" type="text" placeholder="name or Username" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"/>
                @error('name')
                <p class="text-size-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

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
            <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                <input type="password" name="password_confirmation" placeholder="confirm password" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"/>
                @error('password_confirmation')
                <p class="text-size-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role">Choose Role:</label>
                <select name="role" id="role">
                    <option value="user">User</option>
                    <option value="organizer">Organizer</option>
                </select>
            </div>

            <div id="organization_name_input" style="display: none;">
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-indigo-500">
                    <input name="organization_name" type="text" placeholder="Organization Name" class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"/>
                    @error('organization_name')
                    <p class="text-size-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button class="transform rounded-sm bg-indigo-600 p-2 font-bold duration-300 hover:bg-indigo-400">register</button>
        </form>

        <p class="text-center text-lg">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-indigo-500 underline-offset-4 hover:underline">Login</a>
        </p>

    </section>
</main>

<script>
    document.getElementById('role').addEventListener('change', function() {
        const organizationNameInput = document.getElementById('organization_name_input');
        if (this.value === 'organizer') {
            organizationNameInput.style.display = 'block';
        } else {
            organizationNameInput.style.display = 'none';
        }
    });
</script>

</body>
</html>
