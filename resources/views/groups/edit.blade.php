@extends('layouts.layout')

@section('title')
    Edit group: {{ $group->name }}
@endsection

@section('content')
    @if ($errors->any())
        <div class="p-3 rounded bg-red-500 text-white m-3">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>

    <form method="POST" action="{{ route('groups.update', $group->id) }}">
        @method('PUT')
        @csrf
        <div>
            <label class="block text-sm font-bold text-gray-700" for="name">Group name</label>
            <input value="{{ $group->name }}" type="text" name="name" id="name" placeholder="Name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div class="flex items-center justify-start mt-4 gap-x-2">
            <x-primary-button type="submit">Submit</x-primary-button>
            &nbsp;
            <x-secondary-button onclick="history.back()">Back</x-secondary-button>
        </div>
    </form>
@endsection
