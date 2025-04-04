<x-layout>
    <style>
        /* Apply alternating background color */
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
            /* Light gray for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
            /* White for odd rows */
        }
    </style>

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
            <div class="w-1/2 h-full max-h-[700px] flex flex-col space-y-4 border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-bold text-gray-800">Cart Summary</h3>
                <div id="cart-items" class="space-y-4 overflow-auto flex-grow">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead class="sticky top-0 bg-gray-300 z-10">
                            <tr class="bg-gray-300 border-b border-white">
                                <th class="w-6/12 border border-white px-4 py-2 text-left">Name</th>
                                <th class="w-1/12 border border-white px-4 py-2 text-right">Qty</th>
                                <th class="w-2/12 border border-white px-4 py-2 text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="border border-gray-300 px-4 py-2 text-center font-bold" colspan="3">Your cart
                                is empty.
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-1/2 h-full max-h-[700px] flex flex-col space-y-4 border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-bold text-gray-800">Payment Method</h3>
                <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="cash" checked
                            onchange="updatePaymentMethod(this.value)"
                            class="form-radio text-blue-500 focus:ring-blue-500">
                        <span>Cash</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="credit_card"
                            onchange="updatePaymentMethod(this.value)"
                            class="form-radio text-blue-500 focus:ring-blue-500">
                        <span>Credit Card</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="payment_method" value="debit_card"
                            onchange="updatePaymentMethod(this.value)"
                            class="form-radio text-blue-500 focus:ring-blue-500">
                        <span>Debit Card</span>
                    </label>
                </div>

                <!-- Hidden form for card details -->
                <div id="card-details" class="mt-4 hidden p-4 border border-gray-300 rounded-lg">
                    <h4 class="text-md font-bold text-gray-800 mb-2">Card Details</h4>
                    <label class="block mb-2">
                        <span class="text-gray-700">Card Number</span>
                        <input type="text" id="card-number" name="card_number" maxlength="16"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter card number">
                    </label>
                    <label class="block mb-2">
                        <span class="text-gray-700">Cardholder Name</span>
                        <input type="text" id="card-holder" name="card_holder"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter name on card">
                    </label>
                    <div class="flex space-x-2">
                        <label class="block w-1/2">
                            <span class="text-gray-700">Expiration Date</span>
                            <input type="month" id="card-expiry" name="card_expiry"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </label>
                        <label class="block w-1/2">
                            <span class="text-gray-700">CVV</span>
                            <input type="text" id="card-cvv" name="card_cvv" maxlength="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="123">
                        </label>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold text-gray-800 flex justify-between">
                        <span>Total:</span>
                        <p><span id="cart-total"> 0.00</span></p>
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
                <form id="checkout-form" method="POST" action="{{ route('checkout') }}">
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

        <div class="w-full bg-white shadow rounded-lg p-4 grid grid-cols-3 md:grid-cols-5 gap-4 flex-grow">
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

    <script>
        // Ensure the script is at the bottom, so the DOM is loaded when the function is called
        let cart = [];

        // Function to format the price with two decimal places and thousands separator
        function formatPrice(price) {
            return price.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function addToCart(id, name, price, availableQuantity) {
            let quantityInput = document.getElementById(`quantity-${id}`);
            let quantity = quantityInput ? parseInt(quantityInput.value) : 1;

            // Check if the quantity exceeds the available stock in the database
            if (quantity > availableQuantity) {
                alert(`You can only add up to ${availableQuantity} of this item.`);
                return; // Stop the function from proceeding if the quantity is too high
            }

            // Check if the item is already in the cart
            let existingItemIndex = cart.findIndex(item => item.id === id);

            if (existingItemIndex !== -1) {
                // If the item is already in the cart, check if adding this quantity exceeds available stock
                let newQuantity = cart[existingItemIndex].quantity + quantity;

                if (newQuantity > availableQuantity) {
                    alert(`You cannot add more than ${availableQuantity} of this item.`);
                    return; // Stop the function if adding exceeds the stock
                }

                // If the quantity is valid, update the existing item's quantity
                cart[existingItemIndex].quantity = newQuantity;
            } else {
                // If the item is not in the cart, add a new item
                cart.push({ id, name, price, quantity });
            }

            // Update the cart UI
            updateCartUI();
        }

        function updateCartUI() {
            let cartItemsContainer = document.getElementById('cart-items');
            let cartBody = cartItemsContainer.querySelector('tbody');

            // Clear the current cart items in the tbody
            cartBody.innerHTML = '';

            // If the cart is empty, show the "Your cart is empty" message
            if (cart.length === 0) {
                cartBody.innerHTML = `
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-center font-bold" colspan="3">Your cart is empty.</td>
            </tr>
        `;
            } else {
                // Loop through the cart items and add them to the UI
                cart.forEach(item => {
                    let row = document.createElement('tr');
                    row.classList.add('border-b', 'border-gray-300');
                    row.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${item.name}</td>
                <td class="border border-gray-300 px-4 py-2 text-right">${item.quantity}</td>
                <td class="px-4 py-2 flex justify-between"><div>₱</div> <div>${formatPrice(item.price)}</div></td>
            `;
                    cartBody.appendChild(row);
                });
            }

            updateCartTotal();
        }

        function updateCartTotal() {
            let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('cart-total').textContent = `₱ ${formatPrice(total)}`;
        }

        function clearCart() {
            cart = [];
            updateCartUI();
        }

        function updatePaymentMethod(value) {
            const cardDetails = document.getElementById("card-details");
            document.getElementById("payment-method-field").value = value;

            if (value === "credit_card" || value === "debit_card") {
                cardDetails.classList.remove("hidden");
            } else {
                cardDetails.classList.add("hidden");
            }
        }
    </script>
</x-layout>