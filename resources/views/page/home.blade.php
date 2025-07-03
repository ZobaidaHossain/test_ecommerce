@extends('frontend.master')

@push('content')
@if(session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif

@if(session('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
@endif

@if(session('warningMessage'))
    <div class="alert alert-warning">
        {{ session('warningMessage') }}
    </div>
@endif
@foreach ($sliders as $slider)
    <section id="hero" style="background-image: url('{{ asset('storage/'.$slider->image) }}');">
        <h4>{{ $slider->heading }}</h4>
        <h2>{{ $slider->title }}</h2>
        <h1>{{ $slider->title_two }}</h1>
        <p>{{ $slider->subtitle }}</p>
        <button style="background-image:url('{{ asset('images/button.png') }}')">Shop Now</button>
    </section>
@endforeach


<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="images/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="images/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="images/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="images/features/f4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="images/features/f5.png" alt="">
        <h6>Happy Sell</h6>
    </div>
    <div class="fe-box">
        <img src="images/features/f6.png" alt="">
        <h6>F24/7 Support</h6>
    </div>
</section>

<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        @foreach($products as $product)
        <div class="pro" data-bs-toggle="modal" data-bs-target="#productModal"
            onclick="showProductDetails('{{ $product->title }}', '{{ $product->price }}', '{{ asset('storage/' .$product->image) }}', '{{ $product->brand }}')">
            <img src="{{ asset('storage/' .$product->image) }}" alt="Product Image">
            <div class="des">
                <span>{{ $product->brand }}</span>
                <h5>{{ $product->title }}</h5>

                <h4>${{ $product->price }}</h4>
            </div>
            {{-- <a href="#"><i class="fas fa-shopping-cart cart"></i></a> --}}
        </div>
        @endforeach
    </div>
</section>


{{-- Modal --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalProductImage" src="" class="img-fluid mb-3" alt="Product Image">
                <h5 id="modalProductTitle"></h5>
                <p id="modalProductPrice"></p>
                <p id="modalProductBrand"></p>
                <!-- Add to Cart -->
                <button class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
            </div>
        </div>
    </div>
</div>


{{-- end --}}



@endpush

@push('js')

    <script>
        function showProductDetails(title, price, image, brand) {
            document.getElementById('modalProductTitle').innerText = title;
            document.getElementById('modalProductPrice').innerText = `$${price}`;
            document.getElementById('modalProductImage').src = image;
            document.getElementById('modalProductBrand').innerText = `Brand: ${brand}`;

            sessionStorage.setItem('currentProduct', JSON.stringify({ title, price, image, brand }));
        }

//  function addToCart() {
//     const product = JSON.parse(sessionStorage.getItem('currentProduct'));

//     if (product) {
//         let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

//         // Check if the product already exists in the cart
//         const isDuplicate = cart.some(item => item.title === product.title);

//         if (isDuplicate) {
//             alert('Product already added to the cart!');
//         } else {
//             cart.push(product);
//             sessionStorage.setItem('cart', JSON.stringify(cart));

//             // Notify user
//             alert(`${product.title} has been added to your cart!`);

//             // Update cart count dynamically
//             updateCartCount();
//         }
//     } else {
//         alert('No product selected. Please try again.');
//     }
// }

function addToCart() {
    const product = JSON.parse(sessionStorage.getItem('currentProduct'));

    if (!product) {
        alert('No product selected. Please try again.');
        return;
    }

    // Make AJAX request to add product to cart
    fetch("{{ route('frontend.cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(product)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            updateCartCount(); // Refresh the cart count
        } else {
            alert("Error adding product to cart.");
        }
    })
    .catch(error => console.error("Error:", error));
}


    </script>




@endpush
