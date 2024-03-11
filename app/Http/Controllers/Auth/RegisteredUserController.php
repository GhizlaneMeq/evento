<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,organizer'], 
            'organization_name' => ['required_if:role,organizer'] 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        //dd($user->id);

        if ($request->role === 'organizer') {
            Organizer::create([
                'user_id' => $user->id,
                'organization_name' => $request->organization_name
            ]);
        }
        $user->roles()->attach([
            Role::where('name', 'user')->first()->id,
            Role::where('name', 'organizer')->first()->id,
        ]);

        Auth::login($user);

        switch ($user) {
            case $user->isAdmin():
                return redirect()->route('admin.dashboard.index');
                break;
            case $user->isOrganizer():
                return redirect()->route('organizer.dashboard.index');
                break;
            case $user->isUser():
                return redirect()->route('user.events.index');
                break;
            default:
                return redirect(RouteServiceProvider::HOME);
                break;
        }
    }
}
