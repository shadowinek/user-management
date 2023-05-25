<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::simplePaginate(10);

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::all(['id', 'name'])->sortBy('name');

        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $group = Group::create([
            'name' => $request->get('name'),
        ]);

        $users = array_filter($request->get('users') ?? []);
        $group->users()->sync($users);

        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    public function destroy(Group $group)
    {
        if ($group->users()->count() > 0 || $group->is_admin_group) {
            return redirect()->route('groups.index')->with('error', 'You can\'t delete this group.');
        } else {
            $group->delete();

            return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
        }
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $users = User::all(['id', 'name'])->sortBy('name');

        return view('groups.edit', compact('group', 'users'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $group->update([
            'name' => $request->get('name'),
        ]);

        $users = array_filter($request->get('users') ?? []);

        // can't remove yourself from the group
        if ($group->is_admin_group && $group->users()->get()->contains('id', Auth::user()->id)) {
            $users[] = Auth::user()->id;
        }

        $group->users()->sync($users);

        return redirect()->route('groups.index')->with('success', 'Group updated successfully');
    }
}
