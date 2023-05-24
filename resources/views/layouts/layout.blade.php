<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 text-gray-900">
                        @if ($message = Session::get('success'))
                            <div class="bg-gray-100 text-green-600 font-bold rounded-t px-4 py-24">
                                <p>{{ $message }}</p>
                            </div>
                            <br><br>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-24">
                                <p>{{ $message }}</p>
                            </div>
                            <br><br>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
