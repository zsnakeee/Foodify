<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="eCommerce,shop,fashion">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

        <title>{{ $title ?? config('app.name') }} {{ $title ? '| ' . config('app.name') : '' }}</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <div class="preloader">
            <div class="loader">
                <img src="{{ asset('assets/images/loader.gif') }}" alt="Loader">
            </div>
        </div>

        <div class="offcanvas__overlay"></div>

        <div class="sidemenu-wrapper-cart">
            <div class="sidemenu-content">
                <div class="widget widget-shopping-cart">
                    <h4>My cart</h4>
                    <div class="sidemenu-cart-close"><i class="far fa-times"></i></div>
                    <div class="widget-shopping-cart-content">
                        <ul class="pesco-mini-cart-list">
                            <li class="sidebar-cart-item">
                                <a href="#" class="remove-cart">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <a href="#">
                                    <img src="assets/images/products/cart-1.jpg" alt="cart image">
                                    leggings with mesh panels
                                </a>
                                <span class="quantity">1 × <span><span class="currency">$</span>940.00</span></span>
                            </li>
                            <li class="sidebar-cart-item">
                                <a href="#" class="remove-cart"><i class="far fa-trash-alt"></i></a>
                                <a href="#">
                                    <img src="assets/images/products/cart-2.jpg" alt="cart image">
                                    Summer dress with belt
                                </a>
                                <span class="quantity">1 × <span><span class="currency">$</span>940.00</span></span>
                            </li>
                            <li class="sidebar-cart-item">
                                <a href="#" class="remove-cart"><i class="far fa-trash-alt"></i></a>
                                <a href="#">
                                    <img src="assets/images/products/cart-3.jpg" alt="cart image">
                                    Floral print sundress
                                </a>
                                <span class="quantity">1 × <span><span class="currency">$</span>940.00</span></span>
                            </li>
                            <li class="sidebar-cart-item">
                                <a href="#" class="remove-cart"><i class="far fa-trash-alt"></i></a>
                                <a href="#">
                                    <img src="assets/images/products/cart-4.jpg" alt="cart image">
                                    Sheath Gown Red Colors
                                </a>
                                <span class="quantity">1 × <span><span class="currency">$</span>940.00</span></span>
                            </li>
                        </ul>
                        <div class="cart-mini-total">
                            <div class="cart-total">
                                <span><strong>Subtotal:</strong></span> <span class="amount">1 × <span><span
                                            class="currency">$</span>940.00</span></span>
                            </div>
                        </div>
                        <div class="cart-button-box">
                            <a href="checkout.html" class="theme-btn style-one">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.header')

        <!--====== Main Bg  ======-->
        <main class="main-bg">
            {{ $slot ?? '' }}
        </main>


        @include('partials.footer')

        <div class="back-to-top">
            <i class="far fa-angle-up"></i>
        </div>
    </body>
</html>
