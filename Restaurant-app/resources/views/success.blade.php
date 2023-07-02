<x-guest-layout>
    @if(isset($order))
    <div class="container w-full px-5 py-6 mx-auto">
        <h1>Thank you!</h1>
        <p>You order is prepared</p>
        {{$order->order_number}}

        <h3>Your products:</h3>
        <ul>
            @foreach($order->menu as $product)
                <li>
                    {{ $product->name }} - {{ $product->price }}$ x{{ $product->pivot->quantity }}
                </li>
            @endforeach
        </ul>
    </div>
@elseif(isset($reservation))
<div class="container w-full px-5 py-6 mx-auto">
    <h1>Thank you!</h1>
    <p>You reservation is created</p>
</div>
@else
    <p></p>
@endif
</x-guest-layout>