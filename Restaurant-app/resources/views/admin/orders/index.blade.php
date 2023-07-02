<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Order Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Products
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Person
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Full Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Order Price
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
                        @foreach ($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    {{ $order->order_number }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($order->menu as $product)
                                        <li>
                                            {{ $product->name }} - x{{ $product->pivot->quantity }}
                                        </li>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->last_name . ' ' . $order->first_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->phone_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->street }} {{ $order->city }} {{ $order->post_code }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->order_price }}
                                </td>
                                <td class="px-6 py-4 @if($order->status === 'Active')
                                    text-green-600
                                @endif">
                                    {{ $order->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" onsubmit="return confirm('Are you sure?');"
                                            class="text-lg font-semibold text-blue-600 hover:text-blue-500 rounded-lg">Done</a>
                                        <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}"
                                            class="text-lg font-semibold text-red-600 hover:text-red-500 rounded-lg"
                                            onsubmit="return confirm('Are you sure?');">
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
