<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $groups = Group::all(['id', 'name', 'is_admin_group'])->sortBy('name');

        return view('users.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $groups = array_filter($request->get('groups') ?? []);
        $user->groups()->sync($groups);

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
        $groups = Group::all(['id', 'name', 'is_admin_group'])->sortBy('name');

        return view('users.edit', compact('user', 'groups'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        $groups = array_filter($request->get('groups') ?? []);

        // can't remove admin group if you are an admin
        if (Auth::user()->id === $user->id) {
            $user_admin_groups = $user->groups()->get()->filter(function ($g) {
                return $g->is_admin_group;
            });

            foreach ($user_admin_groups as $group) {
                $groups[] = $group->id;
            }
        }

        $user->groups()->sync($groups);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
