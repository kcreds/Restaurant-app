<x-guest-layout>
    @if (isset($order))
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="flex items-center min-h-screen ">
                <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl shadow-emerald-900">
                    <div class="flex flex-col md:flex-row">
                        <div class="h-32 md:h-auto md:w-1/2">
                            <img class="object-cover w-full h-full"
                                src="https://cdn.pixabay.com/photo/2016/11/08/06/45/couple-1807617_960_720.jpg"
                                alt="img" />
                        </div>
                        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                            <div class="w-full">
                                <h3 class="mb-4 text-2xl font-bold text-rose-300">Thank You!</h3>

                                <p>You order is prepared :)</p>
                                <br>

                                <ul>
                                    <li>
                                        Order Number: <span
                                            class="text-rose-300 font-bold">{{ $order->order_number }}</span>
                                    </li>
                                    <br>
                                    <h3>Your products:</h3>
                                    <br>
                                    <ul>
                                        @foreach ($order->menu as $product)
                                            <li>
                                                <span class="text-rose-300 font-bold">{{ $product->name }}</span> -
                                                <span class="text-rose-300 font-bold">{{ $product->price }}$</span>
                                                <span
                                                    class="text-rose-300 font-bold">x{{ $product->pivot->quantity }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>Thank you!</h1>
        <p>You order is prepared</p>
        {{ $order->order_number }}

        <h3>Your products:</h3>
        <ul>
            @foreach ($order->menu as $product)
                <li>
                    {{ $product->name }} - {{ $product->price }}$ x{{ $product->pivot->quantity }}
                </li>
            @endforeach
        </ul>
        </div>
    @elseif(isset($reservation))
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="flex items-center min-h-screen ">
                <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl shadow-emerald-900">
                    <div class="flex flex-col md:flex-row">
                        <div class="h-32 md:h-auto md:w-1/2">
                            <img class="object-cover w-full h-full"
                                src="https://cdn.pixabay.com/photo/2016/11/08/06/45/couple-1807617_960_720.jpg"
                                alt="img" />
                        </div>
                        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                            <div class="w-full">
                                <h3 class="mb-4 text-2xl font-bold text-rose-300">Thank You!</h3>

                                <p>Your reservation is ready :)</p>
                                <br>

                                <ul>
                                    <li>
                                        Booker: <span class="text-rose-300 font-bold">{{ $reservation->last_name }}
                                            {{ $reservation->first_name }}</span>
                                    </li>
                                    <li>
                                        Email: <span class="text-rose-300 font-bold">{{ $reservation->email }}</span>
                                    </li>
                                    <li>
                                        Phone Number: <span
                                            class="text-rose-300 font-bold">{{ $reservation->phone_number }}</span>
                                    </li>
                                    <li>
                                        Reservation Date: <span
                                            class="text-rose-300 font-bold">{{ $reservation->reservation_date }}</span>
                                    </li>
                                    <li>
                                        Gusets: <span
                                            class="text-rose-300 font-bold">{{ $reservation->guest_number }}</span>
                                    </li>
                                    <li>
                                        Table: <span
                                            class="text-rose-300 font-bold">{{ $reservation->table->name }}</span>
                                    </li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p></p>
    @endif
</x-guest-layout>
