<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'You can\'t delete an admin user. You need to remove him from an admin group first.');
        } else {
            $user->groups()->detach($user->groups);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        }
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user->update([
            'name' => $request->get('name'),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
