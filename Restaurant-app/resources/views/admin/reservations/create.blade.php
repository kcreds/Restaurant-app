<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-2 p-2 bg-slate-100 rounded">

                <form method="POST" action="{{ route('admin.reservations.store') }}" class="">
                    @csrf
                    <div class="mb-6">
                        <label for="first_name" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            First Name</label>
                        <input value="{{ old('first_name') }}" name="first_name" type="text" id="first_name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('first_name')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="last_name" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Last Name</label>
                        <input name="last_name" value="{{ old('last_name') }}" type="text" id="last_name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('last_name')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            E-mail</label>
                        <input name="email" value="{{ old('email') }}" type="email" id="email"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('email')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="phone_number" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Phone Number</label>
                        <input name="phone_number" value="{{ old('phone_number') }}" type="number" id="phone_number"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('phone_number')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="reservation_date"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Reservation Date</label>
                        <input name="reservation_date" value="{{ old('reservation_date') }}" type="datetime-local"
                            id="reservation_date"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('reservation_date')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="guest_number" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Guest Number</label>
                        <input name="guest_number" value="{{ old('number') }}" type="number" id="guest_number"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('guest_number')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="table_id"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">Table</label>
                        <select name="table_id" id="table_id"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->name }} ({{$table->guest_number}} Guests)</option>
                            @endforeach
                        </select>

                        @error('table_id')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="flex justify-end m-2 p-2">
                        <button type="submit"
                            class="text-white mt-5 px-4 py-2 mr-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Save</button>

                        <a href="{{ route('admin.reservations.index') }}"
                            class="text-white mt-5 px-4 py-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
