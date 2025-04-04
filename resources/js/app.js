import './bootstrap';

let cart = {};
let cartTotal = 0;
let discountType = 'percentage';
let discountValue = 0;

function addToCart(id, name, price, maxQuantity) {
    if (!cart[id]) {
        cart[id] = { name, price, quantity: 1, maxQuantity };
    } else {
        if (cart[id].quantity >= maxQuantity) {
            alert(`Cannot add more of "${name}". Maximum available quantity is already in the cart.`);
            return;
        }
        cart[id].quantity++;
    }
    updateCart();
}

function updateCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartDataInput = document.getElementById('cart-data');
    const discountTotalElement = document.getElementById('discount-total');
    const discountTypeField = document.getElementById('discount-type-field');
    const discountValueField = document.getElementById('discount-value-field');

    cartItemsContainer.innerHTML = '';
    let total = 0;

    if (Object.keys(cart).length === 0) {
        cartItemsContainer.innerHTML = '<td class="border border-gray-300 px-4 py-2 text-center font-bold" colspan="5">Your cart is empty.</td>';
    } else {
        const table = document.createElement('table');
        table.className = 'w-full border-collapse border border-gray-200';
        table.innerHTML = `
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="w-6/12 border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="w-1/12 border border-gray-300 px-4 py-2 text-right">Qty</th>
                    <th class="w-2/12 border border-gray-300 px-4 py-2 text-right">Price</th>
                </tr>
            </thead>
        `;
        const tbody = document.createElement('tbody');
        Object.entries(cart).forEach(([id, item]) => {
            total += item.price * item.quantity;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="w-6/12 border border-gray-300 px-4 py-2">${item.name}</td>
                <td class="w-1/12 border border-gray-300 px-4 py-2 text-right">${item.quantity}</td>
                <td class="w-2/12 border border-gray-300 px-4 py-2 text-right">₱${(item.price * item.quantity).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
            `;
            tbody.appendChild(row);
        });
        table.appendChild(tbody);
        cartItemsContainer.appendChild(table);
    }
    
    cartTotal = total;
    applyDiscount();
    cartDataInput.value = JSON.stringify(cart);
    discountTypeField.value = discountType;
    discountValueField.value = discountValue;
}

function clearCart() {
    cart = {};
    cartTotal = 0;
    discountType = 'percentage';
    discountValue = 0;
    updateCart();
}