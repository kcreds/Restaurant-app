<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="container my-12 py-12 mx-auto px-4 md:px-6 lg:px-12">

            <!--Section: Design Block-->
            <section class="mb-20 text-gray-800">

                <h5 class="text-xl font-bold mb-6">Statistics</h5>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="mb-6 md:mb-0">
                        <div class="block shadow-lg rounded-xl">
                            <div class="flex justify-start items-center p-6 bg-white rounded-t-lg">
                                <div
                                    class="bg-indigo-500 text-white rounded-md flex justify-center items-center w-12 h-12">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-6 h-6"
                                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="currentColor"
                                            d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-500 mb-0.5">Visits Today</p>
                                    <p class="mb-0 flex justify-start">
                                        <span class="text-xl font-semibold mr-3">{{ session('visits', 0) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray-100 rounded-b-lg px-6 py-2.5">
                                <p
                                    class="text-indigo-500 hover:text-indigo-700 focus:text-indigo-700 active:text-indigo-700 transition duration-300 ease-in-out text-sm font-medium">
                                    Last visit date: {{ session('last_visit_date', 'Never') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 md:mb-0">
                        <div class="block shadow-lg rounded-xl">
                            <div class="flex justify-start items-center p-6 bg-white rounded-t-lg">
                                <div
                                    class="bg-indigo-500 text-white rounded-md flex justify-center items-center w-12 h-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M240 144A96 96 0 1 0 48 144a96 96 0 1 0 192 0zm44.4 32C269.9 240.1 212.5 288 144 288C64.5 288 0 223.5 0 144S64.5 0 144 0c68.5 0 125.9 47.9 140.4 112h71.8c8.8-9.8 21.6-16 35.8-16H496c26.5 0 48 21.5 48 48s-21.5 48-48 48H392c-14.2 0-27-6.2-35.8-16H284.4zM144 80a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM400 240c13.3 0 24 10.7 24 24v8h96c13.3 0 24 10.7 24 24s-10.7 24-24 24H280c-13.3 0-24-10.7-24-24s10.7-24 24-24h96v-8c0-13.3 10.7-24 24-24zM288 464V352H512V464c0 26.5-21.5 48-48 48H336c-26.5 0-48-21.5-48-48zM48 320h80 16 32c26.5 0 48 21.5 48 48s-21.5 48-48 48H160c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V336c0-8.8 7.2-16 16-16zm128 64c8.8 0 16-7.2 16-16s-7.2-16-16-16H160v32h16zM24 464H200c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-500 mb-0.5">Active Orders</p>
                                    <p class="mb-0 flex justify-start">
                                        <span class="text-xl font-semibold mr-3">{{ $activeOrders }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray-100 rounded-b-lg px-6 py-2.5">
                                <a href="{{ route('admin.orders.index') }}"
                                    class="text-indigo-500 hover:text-indigo-700 focus:text-indigo-700 active:text-indigo-700 transition duration-300 ease-in-out text-sm font-medium">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="block shadow-lg rounded-xl">
                            <div class="flex justify-start items-center p-6 bg-white rounded-t-lg">
                                <div
                                    class="bg-indigo-500 text-white rounded-md flex justify-center items-center w-12 h-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path fill="currentColor"
                                            d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-500 mb-0.5">Upcoming Reservations</p>
                                    <p class="mb-0 flex justify-start">
                                        <span class="text-xl font-semibold mr-3">{{ $activeReservations }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-gray-100 rounded-b-lg px-6 py-2.5">
                                <a href="{{ route('admin.reservations.index') }}"
                                    class="text-indigo-500 hover:text-indigo-700 focus:text-indigo-700 active:text-indigo-700 transition duration-300 ease-in-out text-sm font-medium">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
        
    </div>
</x-admin-layout>
