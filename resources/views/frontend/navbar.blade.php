<section id="header">
    <a href="{{route('frontend.home')}}"><img src="images/logo.png" class="logo" alt=""></a>
    <div>
        <ul id="navbar">
            <li><a class="{{ Route::is('frontend.home') ? 'active' : '' }}" href="{{ route('frontend.home') }}">Home</a></li>
            <li><a class="{{ Route::is('frontend.shop') ? 'active' : '' }}" href="{{ route('frontend.shop') }}">Shop</a></li>
            <li><a class="{{ Route::is('frontend.blog') ? 'active' : '' }}" href="{{ route('frontend.blog') }}">Blog</a></li>
            <li><a class="{{ Route::is('frontend.about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">About</a></li>
            <li><a class="{{ Route::is('frontend.contact') ? 'active' : '' }}" href="{{ route('frontend.contact') }}">Contact</a></li>
            <li id="lg-bag">
                {{-- <a href="{{ route('frontend.cart') }}">
                    <i class="far fa-shopping-bag"></i>
                    <span id="cart-count">0</span> <!-- Cart count -->
                </a> --}}
                <a href="{{ route('frontend.cart') }}"> <i class="far fa-shopping-bag"></i> (<span id="cart-count">0</span>)</a>
            </li>



        </ul>
    </div>
    <div id="mobile">
        <a href="{{ route('frontend.cart') }}"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
