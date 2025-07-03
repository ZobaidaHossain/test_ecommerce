@extends('frontend.master')

@push('content')
<!-- Page Header Section -->
<section id="page-header" class="about-header" style="background-image: url('{{ asset('images/about/banner.png') }}');">
    <h2>#cart</h2>
    <p>Add your coupon code & SAVE up to 70%!</p>
</section>

<!-- Cart Items Section -->
<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody id="cartItems">
            <!-- Items will be dynamically inserted here -->
        </tbody>
    </table>
</section>

<!-- Cart Totals Section -->
<section id="cart-add" class="section-p1">
    <div class="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td id="cartSubtotal">$0.00</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>Free</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td id="cartTotal"><strong>$0.00</strong></td>
            </tr>
        </table>
        {{-- <button class="normal" >Proceed to checkout</button> --}}
<form action="{{ route('frontend.payment') }}" method="POST">
    @csrf
    <button type="submit" class="normal">Proceed to checkout</button>
</form>




    </div>
</section>
@endpush

@push('js')
<script>
    // Load cart items on page load
    function loadCartItems() {
        fetch("{{ route('frontend.cart.get') }}")
            .then(response => {
                if (!response.ok) throw new Error('Failed to fetch cart items');
                return response.json();
            })
            .then(data => {
                const cartBody = document.getElementById('cartItems');
                const cartSubtotal = document.getElementById('cartSubtotal');
                const cartTotal = document.getElementById('cartTotal');
                cartBody.innerHTML = ''; // Clear existing items
                let subtotal = 0;

                data.cart.forEach((item, index) => {
                    const itemPrice = parseFloat(item.price);
                    const itemQuantity = item.quantity || 1;
                    const itemSubtotal = itemPrice * itemQuantity;
                    subtotal += itemSubtotal;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <a href="#" onclick="removeItem(${index})">
                                <i class="fas fa-times-circle" style="color:black"></i>
                            </a>
                        </td>
                        <td><img src="${item.image}" alt="Product Image"></td>
                        <td>${item.title}</td>
                        <td>$${itemPrice.toFixed(2)}</td>
                        <td>
                            <input type="number" value="${itemQuantity}"
                                   onchange="updateQuantity(${index}, this.value)" min="1">
                        </td>
                        <td id="subtotal-${index}">$${itemSubtotal.toFixed(2)}</td>
                    `;
                    cartBody.appendChild(row);
                });

                cartSubtotal.innerText = `$${subtotal.toFixed(2)}`;
                cartTotal.innerText = `$${subtotal.toFixed(2)}`;
            })
            .catch(error => console.error("Error loading cart:", error));
    }
    function removeItem(index) {
    fetch("{{ route('frontend.cart.remove') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({ index: index }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadCartItems(); // Reload the cart items
            } else {
                alert(data.message || "Failed to remove item.");
            }
        })
        .catch(error => console.error("Error removing item:", error));
}


    // Remove item from the cart


    // Update quantity of a cart item
    function updateQuantity(index, quantity) {
        const newQuantity = parseInt(quantity);
        if (isNaN(newQuantity) || newQuantity < 1) {
            alert("Invalid quantity.");
            return;
        }

        fetch("{{ route('frontend.cart.update') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ index: index, quantity: newQuantity }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) loadCartItems();
                else alert("Failed to update quantity.");
            })
            .catch(error => console.error("Error updating quantity:", error));
    }

    // Proceed to checkout
    function proceedToCheckout() {
        fetch("{{ route('frontend.checkout') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({}),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = '/'; // Redirect to the desired page
                } else {
                    alert(data.error || "Checkout error.");
                }
            })
            .catch(error => console.error("Checkout error:", error));
    }

    // Initialize cart loading on page load
    document.addEventListener('DOMContentLoaded', loadCartItems);
</script>
@endpush
