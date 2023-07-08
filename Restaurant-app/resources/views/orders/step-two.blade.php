<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen ">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="https://cdn.pixabay.com/photo/2016/11/08/06/45/couple-1807617_960_720.jpg"
                            alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-2xl font-bold text-rose-300">Make Order</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-100 p-1 text-xs font-medium leading-none text-center text-rose-300 bg-emerald-900 rounded-full">
                                    Step 2</div>
                            </div>
                            <form method="POST" action="{{ route('orders.store.step.two') }}">
                                @csrf
                                <div class="sm:col-span-6 pt-5">
                                    <label for="selected_products" class="block text-sm font-medium">Choose
                                        Products</label>
                                    <div class="mt-1">
                                        <div class="relative">
                                            <select required name="selected_products[]" id="selected_products" multiple
                                                class="block appearance-none w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }} -
                                                        {{ $product->price }}$</option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="absolute top-0 right-0 h-full w-10 text-center text-gray-600 pointer-events-none">
                                                <svg class="h-5 w-5 mt-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    @error('selected_products')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="quantityFieldsContainer" class="sm:col-span-6 pt-5">
                                </div>


                                <div id="totalPrice" class="mt-3 font-bold">Total Price: $0.00</div>
                                <input type="hidden" name="order_price" id="order_price">

                                <div class="mt-6 p-4 flex justify-between space-x-3">
                                    <a href="{{ route('orders.step.one') }}"
                                        class="px-4 py-2 font-bold bg-emerald-900 hover:bg-emerald-700 rounded-lg text-rose-300">Back</a>
                                    <button type="submit"
                                        class="px-4 py-2 font-bold bg-emerald-900 hover:bg-emerald-700 rounded-lg text-rose-300">Pay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('selected_products');
            const quantityFieldsContainer = document.getElementById('quantityFieldsContainer');
            const totalPriceSpan = document.getElementById('totalPrice');
            const totalPriceInput = document.getElementById('order_price');
            let previousQuantities = {};

            function updateTotalPrice() {
                const selectedOptions = Array.from(selectElement.selectedOptions);
                let totalPrice = 0;

                quantityFieldsContainer.innerHTML = '';

                selectedOptions.forEach(function(option) {
                    const optionText = option.textContent.trim();
                    const name = optionText.split('-')[0].trim();
                    const priceString = optionText.split('-')[1].trim();
                    const price = parseFloat(priceString.replace('$', '').trim());
                    const quantityContainer = document.createElement('div');
                    quantityContainer.classList.add('flex', 'items-center', 'pb-2', 'mb-2', 'border-b',
                        'border-black');

                    const productInfoSpan = document.createElement('span');
                    productInfoSpan.textContent = `${name} - $${price.toFixed(2)}`;
                    productInfoSpan.classList.add('flex-grow', 'pr-4', 'text-left', 'font-semibold', );
                    quantityContainer.appendChild(productInfoSpan);

                    const productId = option.value;
                    const inputField = document.createElement('input');
                    inputField.type = 'number';
                    inputField.name = `product_quantity[${option.value}]`;
                    inputField.value = previousQuantities[productId] || '1';
                    inputField.min = '1';
                    inputField.classList.add('border', 'border-gray-300', 'rounded-lg',
                        'focus:ring-indigo-700', 'focus:border-indigo-700', 'p-2.5', 'dark:bg-white',
                        'dark:border-gray-600', 'dark:placeholder-gray-400', 'dark:text-dark',
                        'dark:focus:ring-indigo-700', 'dark:focus:border-indigo-700', 'w-16');
                    quantityContainer.appendChild(inputField);

                    inputField.addEventListener('input', function() {
                        const quantity = parseInt(inputField.value);
                        if (!isNaN(quantity)) {
                            const previousQuantity = previousQuantities[productId] || 1;
                            totalPrice -= previousQuantity * price;
                            totalPrice += quantity * price;
                            totalPriceSpan.textContent = 'Total Price: $' + totalPrice.toFixed(2);
                            totalPriceInput.value = totalPrice.toFixed(2);
                            previousQuantities[productId] = quantity;
                        }
                    });

                    quantityFieldsContainer.appendChild(quantityContainer);
                    totalPrice += price * (previousQuantities[productId] || 1);
                });

                totalPriceSpan.textContent = 'Total Price: $' + totalPrice.toFixed(2);
                totalPriceInput.value = totalPrice.toFixed(2);
            }

            selectElement.addEventListener('change', updateTotalPrice);
            updateTotalPrice();
        });
    </script>


</x-guest-layout>
