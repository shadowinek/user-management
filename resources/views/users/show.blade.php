@extends('layouts.layout')

@section('title')
    User: {{ $user->name }}
@endsection

@section('content')
    <dl>
        <dt>ID: <strong>{{ $user->id }}</strong></dt>
        <dt>Name: <strong>{{ $user->name }}</strong></dt>
        <dt>Email: <strong>{{ $user->email }}</strong></dt>
        <dt>Admin? <strong>{{ $user->isAdmin() ? "Yes" : "No" }}</strong></dt>
        <br>
        <dt>
            <strong>Groups:</strong>
                @if (count($user->groups) > 0)
                    <ul class="list-disc">
                        @foreach ($user->groups as $group)
                            <li>{{ $group->name }}</li>
                        @endforeach
                    </ul>
                @else
                    No groups
                @endif
        </dt>
    </dl>

    <br>
    <div class="flex items-center justify-start mt-4 gap-x-2">
        <x-secondary-button onclick="history.back()">Back</x-secondary-button>&nbsp;
        <a  href="{{ route('users.edit', $user->id) }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >Edit</a>&nbsp;
        @if (!$user->isAdmin())
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-danger-button type="submit">Delete</x-danger-button>
            </form>
        @endif
    </div>
@endsection
