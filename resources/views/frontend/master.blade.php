<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce website</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font-awesome cdn link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <!-- custom css file link -->
    <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

   @include('frontend.navbar')

  @stack('content')

@include('frontend.footer')

<script>
    // function updateCartCount() {
    //     // Retrieve the cart from sessionStorage
    //     const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    //     const cartCount = cart.length;

    //     // Update the cart count in the navbar
    //     const cartCountElement = document.getElementById('cart-count');
    //     if (cartCountElement) {
    //         cartCountElement.innerText = cartCount;
    //     }
    // }
    function updateCartCount() {
    fetch("{{ route('frontend.cart.get') }}")
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.innerText = data.count;
            }
        })
        .catch(error => console.error("Error:", error));
}

document.addEventListener('DOMContentLoaded', updateCartCount);


    // Ensure the cart count updates on page load
    document.addEventListener('DOMContentLoaded', updateCartCount);
</script>

    <script src="{{asset('frontend/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('js')
</body>
</html>
