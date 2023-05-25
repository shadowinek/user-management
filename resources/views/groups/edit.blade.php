@extends('layouts.layout')

@section('title')
    Edit group: {{ $group->name }}
@endsection

@section('content')
    <form method="POST" action="{{ route('groups.update', $group->id) }}">
        @method('PUT')
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $group->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="users" :value="__('Users (Press Ctrl to not lose the previous selections)')" />
            <select name="users[]" id="users[]" multiple class="block mt-1 w-full" size="15">
                <option value="0">(no user)</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $group->users()->get()->contains('id', $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('users')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-4 gap-x-2">
            <x-primary-button type="submit">Submit</x-primary-button>
            &nbsp;
            <x-secondary-button onclick="history.back()">Back</x-secondary-button>
        </div>
    </form>
@endsection
