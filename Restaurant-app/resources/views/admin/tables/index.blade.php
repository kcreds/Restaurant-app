<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.tables.create') }}"
                    class=" text-white px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg">Create Table</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Guest Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $table->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $table->guest_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $table->location }}
                                </td>
                                <td class="px-6 py-4 @if($table->status === 'Avaliable')
                                    text-green-600
                                @endif"> 
                                    {{ $table->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.tables.edit', $table->id) }}"
                                            class="text-lg font-semibold text-blue-600 hover:text-blue-500 rounded-lg">Edit</a>

                                        <form method="POST" action="{{ route('admin.tables.destroy', $table->id) }}"
                                            class="text-lg font-semibold text-red-600 hover:text-red-500 rounded-lg"
                                            onsubmit="return confirm('Are you sure? This will delete all reservations for this table.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-admin-layout>
