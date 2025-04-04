// Initialize the cart array to store added items
let cart = [];

// Function to add an item to the cart
function addToCart(id, name, price, availableQuantity) {
    // Get the quantity from the input field (you can later make this dynamic)
    let quantityInput = document.getElementById(`quantity-${id}`);
    let quantity = quantityInput ? parseInt(quantityInput.value) : 1;

    // Check if the quantity is greater than the available stock
    if (quantity > availableQuantity) {
        alert(`Cannot add more than ${availableQuantity} items.`);
        return;
    }

    // Check if the item is already in the cart
    let existingItemIndex = cart.findIndex(item => item.id === id);

    if (existingItemIndex !== -1) {
        // If the item is already in the cart, update its quantity
        cart[existingItemIndex].quantity += quantity;
    } else {
        // If the item is not in the cart, add a new item
        cart.push({ id, name, price, quantity });
    }

    // Update the cart UI
    updateCartUI();
}

// Function to update the cart display
function updateCartUI() {
    let cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear the cart items first

    // Loop through the cart items and add them to the UI
    cart.forEach(item => {
        let row = document.createElement('tr');
        row.classList.add('border-b', 'border-gray-300');
        row.innerHTML = `
            <td class="border border-gray-300 px-4 py-2">${item.name}</td>
            <td class="border border-gray-300 px-4 py-2 text-right">${item.quantity}</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₱ ${item.price.toFixed(2)}</td>
        `;
        cartItemsContainer.appendChild(row);
    });

    // Update the total price
    updateCartTotal();
}

// Function to update the cart total
function updateCartTotal() {
    let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    document.getElementById('cart-total').textContent = total.toFixed(2);
}

// Function to clear the cart
function clearCart() {
    cart = []; // Empty the cart array
    updateCartUI(); // Update the UI to show the empty cart
}
