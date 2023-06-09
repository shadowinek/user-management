@extends('layouts.layout')

@section('title')
    Group: {{ $group->name }}
@endsection

@section('content')
    <dl>
        <dt>ID: <strong>{{ $group->id }}</strong></dt>
        <dt>Name: <strong>{{ $group->name }}</strong></dt>
        <dt>Admin group? <strong>{{ $group->is_admin_group ? "Yes" : "No" }}</strong></dt>
        <br>
        <dt>
            <strong>Users:</strong>
                @if (count($group->users) > 0)
                    <ul class="list-disc">
                        @foreach ($group->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                @else
                    No users
                @endif
        </dt>
    </dl>

    <br>
    <div class="flex items-center justify-start mt-4 gap-x-2">
        <x-secondary-button onclick="history.back()">Back</x-secondary-button>&nbsp;
        <a  href="{{ route('groups.edit', $group->id) }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >Edit</a>&nbsp;
        @if ($group->users()->count() === 0 && !$group->is_admin_group)
            <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-danger-button type="submit">Delete</x-danger-button>
            </form>
        @endif
    </div>
@endsection
