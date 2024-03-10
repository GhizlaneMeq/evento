<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        $users = User::paginate(10);
        return view('admin.user.display', compact('users','roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $user->roles()->syncWithoutDetaching($request->roles); 

        return redirect()->back()->with('success', 'User roles updated successfully.');
    }

    public function banUser(User $user)
    {
        $user->update(['banned' => true]);
        return redirect()->back()->with('success', 'User banned successfully');
    }

    public function unbanUser(User $user)
    {
        $user->update(['banned' => false]);
        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User has been deleted successfully.');
    }
}
