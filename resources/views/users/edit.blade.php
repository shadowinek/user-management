@extends('layouts.layout')

@section('title')
    Edit user: {{ $user->name }}
@endsection

@section('content')
     <form method="POST" action="{{ route('users.update', $user->id) }}">
        @method('PUT')
        @csrf
         <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="groups" :value="__('Groups (Press Ctrl to not lose the previous selections)')" />
            <select name="groups[]" id="groups[]" multiple class="block mt-1 w-full" size="15">
                <option value="0">(no group)</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $user->groups()->get()->contains('id', $group->id) ? 'selected' : '' }}>{{ $group->name }}{{ $group->is_admin_group ? '*' : '' }}</option>
                @endforeach
            </select>
            <p class="text-sm">* Admin group</p>
            <x-input-error :messages="$errors->get('groups')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-4 gap-x-2">
            <x-primary-button type="submit">Submit</x-primary-button>
            &nbsp;
            <x-secondary-button onclick="history.back()">Back</x-secondary-button>
        </div>
    </form>
@endsection
