<x-layout>
    <x-slot:heading>
        POS Page
    </x-slot:heading>

    <div class="space-y-4">
        @if(session('success') || session('error'))
            @if (session('message'))
                <div class="bg-green-500 text-white font-bold rounded px-4 py-2 mb-4">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-500 text-white font-bold rounded px-4 py-2 mb-4">
                    {{ session('error') }}
                </div>
            @endif
        @endif

        <div class="w-full flex justify-between items-start gap-4">
            <div class="w-1/2 flex flex-col space-y-4 border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-bold text-gray-800">Cart Summary</h3>
                <div id="cart-items" class="space-y-4 overflow-auto flex-grow">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-300">
                                <th class="w-6/12 border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="w-1/12 border border-gray-300 px-4 py-2 text-right">Qty</th>
                                <th class="w-2/12 border border-gray-300 px-4 py-2 text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="border border-gray-300 px-4 py-2 text-center font-bold" colspan="5">Your cart
                                is empty.
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-1/2 flex flex-col space-y-4 border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-bold text-gray-800">Payment Method</h3>
                <div>
                    <label for="payment-method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment-method" name="payment_method" onchange="updatePaymentMethod(this.value)"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                    </select>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-gray-800 flex justify-between">
                        <span>Total:</span>
                        <p>₱ <span id="cart-total"> 0.00</span></p>
                    </h4>
                </div>

                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-800 flex justify-between">
                        <span>Discount:</span>
                        <p>- <span id="discount-total"> 0.00</span></p>
                    </h3>
                </div>

                <button onclick="clearCart()"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded w-full">
                    Clear List
                </button>
                <form id="checkout-form" method="POST" action="">
                    @csrf
                    <input type="hidden" id="cart-data" name="cart" value="">
                    <input type="hidden" id="discount-type-field" name="discount_type" value="percentage">
                    <input type="hidden" id="discount-value-field" name="discount_value" value="0">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                        Checkout
                    </button>
                </form>
            </div>
        </div>

        <div class="w-full bg-white shadow rounded-lg p-4 flex flex-col space-y-4">
            @foreach ($items as $item)
                <div role="button" class="p-4 bg-white shadow rounded-lg flex flex-col space-y-4 h-full"
                    onclick="addToCart({{ $item->id }}, '{{ $item->name }}', {{ $item->price }}, {{ $item->quantity }})">
                    <h3 class="text-lg font-bold text-gray-800">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-500">₱ {{ number_format($item->price, 2) }}</p>
                    <p class="text-sm text-gray-500">{{ $item->quantity }}</p>
                    <!-- Spacer to push content above -->
                    <div class="flex-grow"></div>
                    <!-- Quantity input and Add button at the bottom -->
                    <div class="w-full hidden">
                        <input type="number" id="quantity-{{ $item->id }}" min="1" max="{{ $item->quantity }}"
                            class="border rounded px-2 py-1 w-full text-center mb-2" placeholder="Quantity" value="1">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>