<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="m-2 p-2 bg-slate-100 rounded">


                <form method="POST" action="{{ route('admin.tables.store') }}" class="">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Name</label>
                        <input value="{{ old('name') }}" name="name" type="name" id="name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('name')
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
                        <label for="status"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">Status</label>
                        <select name="status" id="status"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                            @foreach (App\Enums\TableStatus::cases() as $status)
                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                            @endforeach
                        </select>

                        @error('status')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-6">
                        <label for="location"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">Location</label>
                        <select name="location" id="location"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                            @foreach (App\Enums\TableLocation::cases() as $location)
                                <option value="{{ $location->value }}">{{ $location->name }}</option>
                            @endforeach
                        </select>

                        @error('location')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-end m-2 p-2">
                        <button type="submit"
                            class="text-white mt-5 px-4 py-2 mr-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Save</button>

                        <a href="{{ route('admin.tables.index') }}"
                            class="text-white mt-5 px-4 py-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
