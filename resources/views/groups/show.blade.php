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
        @if ($group->users()->count() === 0 && !$group->is_admin_group)
            <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-danger-button type="submit">Delete</x-danger-button>
            </form>
        @endif
    </div>
@endsection
