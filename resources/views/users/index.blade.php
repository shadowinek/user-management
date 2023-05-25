@extends('layouts.layout')

@section('title')
    User list
@endsection

@section('content')
    <a href="{{ route('users.create') }}"
       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >Add new User</a>

    <br><br>

    <table class="table-auto">
        <tr>
            <th class="border px-6 py-4">#</th>
            <th class="border px-6 py-4">Name</th>
            <th class="border px-6 py-4">Email</th>
            <th class="border px-6 py-4">Actions</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td class="px-6 py-4">{{ $user->id }}</td>
                <td class="px-6 py-4 {{ $user->isAdmin() ? "font-semibold" : ""}}">{{$user->name}}</td>
                <td class="px-6 py-4">{{$user->email}}</td>
                <td class="px-6 py-4 inline-flex">
                    <a  href="{{ route('users.show', $user->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                    >Show</a>&nbsp;

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
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>

    {!! $users->links() !!}
@endsection
