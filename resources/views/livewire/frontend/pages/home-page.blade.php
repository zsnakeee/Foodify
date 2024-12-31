<div>
    <!-- slider -->
    {{--    <div class="tf-slideshow slider-effect-fade slider-grocery position-relative flat-spacing-25 pb_0">--}}
    {{--        <div class="container">--}}
    {{--            <div dir="ltr" class="swiper tf-sw-slideshow radius-20" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="false" data-auto-play="false" data-delay="2000" data-speed="1000">--}}
    {{--                <div class="swiper-wrapper">--}}
    {{--                    <div class="swiper-slide" lazy="true">--}}
    {{--                        <div class="wrap-slider">--}}
    {{--                            <img class="lazyload" data-src="{{ asset("assets/images/slider/slide-gocery1.jpg") }}" src="{{ asset("assets/images/slider/slide-gocery1.jpg") }}" alt="hp-slideshow-01">--}}
    {{--                            <div class="box-content">--}}
    {{--                                <div class="container">--}}
    {{--                                    <h2 class="fade-item fade-item-2 fw-6 heading">Don’t miss amazing <br> grocery deals</h2>--}}
    {{--                                    <p class="fade-item fade-item-1 fw-6 d-block">Save up to 30% off on your first order</p>--}}
    {{--                                    <div class="fade-item fade-item-3">--}}
    {{--                                        <a href="shop-default.html" class="tf-btn btn-fill animate-hover-btn btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="swiper-slide" lazy="true">--}}
    {{--                        <div class="wrap-slider row-end">--}}
    {{--                            <img class="lazyload" data-src="{{ asset("assets/images/slider/slide-gocery2.jpg") }}" src="{{ asset("assets/images/slider/slide-gocery2.jpg") }}" alt="hp-slideshow-02">--}}
    {{--                            <div class="box-content">--}}
    {{--                                <div class="container">--}}
    {{--                                    <h2 class="fade-item fade-item-2 fw-6 heading">Sweet Crunchy <br> Salad</h2>--}}
    {{--                                    <p class="fade-item fade-item-1 fw-6 d-block">Save up to 30% off on your first order</p>--}}
    {{--                                    <div class="fade-item fade-item-3">--}}
    {{--                                        <a href="shop-default.html" class="tf-btn btn-fill animate-hover-btn btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="swiper-slide" lazy="true">--}}
    {{--                        <div class="wrap-slider">--}}
    {{--                            <img class="lazyload" data-src="{{ asset("assets/images/slider/slide-gocery3.jpg") }}" src="{{ asset("assets/images/slider/slide-gocery3.jpg") }}" alt="hp-slideshow-03">--}}
    {{--                            <div class="box-content">--}}
    {{--                                <div class="container">--}}
    {{--                                    <h2 class="fade-item fade-item-2 fw-6 heading">Black Seedless <br> Grapes</h2>--}}
    {{--                                    <p class="fade-item fade-item-1 fw-6 d-block">Save up to 30% off on your first order</p>--}}
    {{--                                    <div class="fade-item fade-item-3">--}}
    {{--                                        <a href="shop-default.html" class="tf-btn btn-fill animate-hover-btn btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="wrap-pagination">--}}
    {{--                    <div class="container">--}}
    {{--                        <div class="sw-dots sw-pagination-slider justify-content-xl-start justify-content-center"></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--        </div>--}}

    {{--    </div>--}}
    <!-- /slider -->

    <!-- Categories -->
    <section class="flat-spacing-30 flat-control-sw">
        <div class="container">
            <div class="flat-title flex-row justify-content-between px-0">
                <span class="title fw-6 wow fadeInUp" data-wow-delay="0s">Featured Categories</span>
                <div class="box-sw-navigation">
                    <div class="sw-dots style-2 medium sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
            <div dir="ltr" class="swiper tf-sw-recent wow fadeInUp"
                 data-preview="6" data-tablet="3" data-mobile="2"
                 data-space-lg="30" data-space-md="30" data-space="15"
                 data-pagination="2" data-pagination-md="3"
                 data-pagination-lg="3">
                <div class="swiper-wrapper">
                    @foreach($this->categories as $category)
                        <div class="swiper-slide">
                            <div class="collection-item-circle has-bg has-bg-3 hover-img">
                                <a @click.prevent="Livewire.navigate('{{ route('categories.view', $category) }}')"
                                   href="{{ route('categories.view', $category) }}" class="collection-image img-style">
                                    <img class="lazyload" data-src="{{ $category->image_url }}"
                                         alt="collection-img" src="{{ $category->image_url }}">
                                </a>
                                <div class="collection-content text-center">
                                    <a @click.prevent="Livewire.navigate('{{ route('categories.view', $category) }}')"
                                       href="{{ route('categories.view', $category) }}"
                                       class="link title fw-5">{{ $category->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /Categories -->


    <!-- Deals -->
    <section class="flat-spacing-8">
        <div class="container">
            <div class="flat-title flex-row justify-content-center px-0">
                <span class="title fw-6 wow fadeInUp" data-wow-delay="0s">Deals Of The Day</span>
            </div>
            <div dir="ltr" class="swiper tf-sw-product-sell" data-preview="3" data-tablet="3" data-mobile="1"
                 data-space-lg="30" data-space-md="15" data-pagination="1" data-pagination-md="3"
                 data-pagination-lg="3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" lazy="true">
                        <div class="card-product style-8 border-0 bg_grey-14 lg">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                         data-src="{{ asset("assets/images/products/grocery-1.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-1.jpg") }}" alt="image-product">
                                    <img class="lazyload img-hover"
                                         data-src="{{ asset("assets/images/products/grocery-2.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-2.jpg") }}" alt="image-product">
                                </a>
                                <div class="list-product-btn absolute-2">
                                    <a href="#quick_add" data-bs-toggle="modal"
                                       class="box-icon bg_white quick-add tf-btn-loading">
                                        <span class="icon icon-bag"></span>
                                        <span class="tooltip">Quick Add</span>
                                    </a>
                                    <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                       class="box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <a href="#quick_view" data-bs-toggle="modal"
                                       class="box-icon bg_white quickview tf-btn-loading">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="on-sale-wrap text-end">
                                    <div class="on-sale-item">-31%</div>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link fw-6">Berry World Strawberries</a>
                                <span class="price"><span class="old-price text_primary">$40.25</span> <span
                                        class="new-price">$30.25</span></span>
                                <div class="pr-stock">
                                    <div class="pr-stock-status d-flex justify-content-between align-items-center">
                                        <div class="pr-stock-available">
                                            <span class="pr-stock-label fs-12 fw-6">Available: </span>
                                            <span class="pr-stock-value fs-12 fw-6">23 </span>
                                        </div>
                                        <div class="pr-stock-sold">
                                            <span class="pr-stock-label fs-12 fw-6">Sold: </span>
                                            <span class="pr-stock-value fs-12 fw-6">80 </span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 23%"
                                             aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="count-down">
                                    <div class="tf-countdown-v2">
                                        <div class="js-countdown" data-timer="8007500"
                                             data-labels="Days,Hours,Mins,Secs"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="card-product style-8 border-0 bg_grey-14 lg">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                         data-src="{{ asset("assets/images/products/grocery-3.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-3.jpg") }}" alt="image-product">
                                    <img class="lazyload img-hover"
                                         data-src="{{ asset("assets/images/products/grocery-4.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-4.jpg") }}" alt="image-product">
                                </a>
                                <div class="list-product-btn absolute-2">
                                    <a href="#quick_add" data-bs-toggle="modal"
                                       class="box-icon bg_white quick-add tf-btn-loading">
                                        <span class="icon icon-bag"></span>
                                        <span class="tooltip">Quick Add</span>
                                    </a>
                                    <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                       class="box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <a href="#quick_view" data-bs-toggle="modal"
                                       class="box-icon bg_white quickview tf-btn-loading">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="on-sale-wrap text-end">
                                    <div class="on-sale-item">-31%</div>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link fw-6">M&S Roast Lamb Dinner</a>
                                <span class="price"><span class="old-price text_primary">$4.70</span> <span
                                        class="new-price">$3.70</span></span>
                                <div class="pr-stock">
                                    <div class="pr-stock-status d-flex justify-content-between align-items-center">
                                        <div class="pr-stock-available">
                                            <span class="pr-stock-label fs-12 fw-6">Available: </span>
                                            <span class="pr-stock-value fs-12 fw-6">5 </span>
                                        </div>
                                        <div class="pr-stock-sold">
                                            <span class="pr-stock-label fs-12 fw-6">Sold: </span>
                                            <span class="pr-stock-value fs-12 fw-6">105 </span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 5%" aria-valuenow="5"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="count-down">
                                    <div class="tf-countdown-v2">
                                        <div class="js-countdown" data-timer="8007500"
                                             data-labels="Days,Hours,Mins,Secs"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="card-product style-8 border-0 bg_grey-14 lg">
                            <div class="card-product-wrapper">
                                <a href="product-detail.html" class="product-img">
                                    <img class="lazyload img-product"
                                         data-src="{{ asset("assets/images/products/grocery-5.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-5.jpg") }}" alt="image-product">
                                    <img class="lazyload img-hover"
                                         data-src="{{ asset("assets/images/products/grocery-6.jpg") }}"
                                         src="{{ asset("assets/images/products/grocery-6.jpg") }}" alt="image-product">
                                </a>
                                <div class="list-product-btn absolute-2">
                                    <a href="#quick_add" data-bs-toggle="modal"
                                       class="box-icon bg_white quick-add tf-btn-loading">
                                        <span class="icon icon-bag"></span>
                                        <span class="tooltip">Quick Add</span>
                                    </a>
                                    <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft"
                                       class="box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <a href="#quick_view" data-bs-toggle="modal"
                                       class="box-icon bg_white quickview tf-btn-loading">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.html" class="title link fw-6">Brown Rice Drink</a>
                                <span class="price text_primary">$1.76</span>
                                <div class="pr-stock">
                                    <div class="pr-stock-status d-flex justify-content-between align-items-center">
                                        <div class="pr-stock-available">
                                            <span class="pr-stock-label fs-12 fw-6">Available: </span>
                                            <span class="pr-stock-value fs-12 fw-6">82 </span>
                                        </div>
                                        <div class="pr-stock-sold">
                                            <span class="pr-stock-label fs-12 fw-6">Sold: </span>
                                            <span class="pr-stock-value fs-12 fw-6">40 </span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 82%"
                                             aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="count-down">
                                    <div class="tf-countdown-v2">
                                        <div class="js-countdown" data-timer="8007500"
                                             data-labels="Days,Hours,Mins,Secs"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /Deals -->

    <!-- Popular product -->
    <section class="flat-spacing-5 pt_0">
        <div class="container">
            <div class="flat-animate-tab">
                <div class="flat-title flat-title-tab flex-row justify-content-between px-0">
                    <span class="title text-nowrap fw-6 wow fadeInUp" data-wow-delay="0s">Popular products</span>
                    <ul class="widget-tab-5" role="tablist">
                        <li class="nav-tab-item">
                            <a wire:navigate href="{{ route('products') }}" class="d-flex align-items-center gap-10">
                                Shop all
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"
                                     fill="none">
                                    <path
                                        d="M1.07692 10L0 8.92308L7.38462 1.53846H0.769231V0H10V9.23077H8.46154V2.61538L1.07692 10Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tf-grid-layout tf-col-2 lg-col-4">
                    @foreach($this->featuredProducts as $product)
                        <div class="card-product visible style-9">
                            <div class="card-product-wrapper">
                                <a wire:navigate href="{{ route('products.view', $product) }}" class="product-img">
                                    <img class="lazyload img-product"
                                         data-src="{{ $product->image_url }}" src="{{ $product->image_url }}"
                                         alt="{{ $product->name }}">
                                    <img class="lazyload img-hover"
                                         data-src="{{ $product->image_url }}" src="{{ $product->image_url }}"
                                         alt="{{ $product->name }}">
                                </a>
                                <div class="list-product-btn absolute-2">
                                    <x-wishlist-btn :product="$product"/>

                                    <div class="box-icon bg_white quickview tf-btn-loading"
                                         x-data="{ product: {{ $product->attributesForQuickView() }} }"
                                         x-on:click="$dispatch('quick-view', product)">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-product-info">
                                <div class="inner-info">
                                    <a wire:navigate href="{{ route('products.view', $product) }}"
                                       class="title link fw-6">{{ $product->name }}</a>
                                    <span class="price fw-6">{{ $product->formatted_price }}</span>
                                </div>
                                <div class="list-product-btn">
                                    <a
                                        {{--                                        x-data="cartHandler({{ $product->id }}, {{ $product->isWished() ? 'true' : 'false' }})"--}}
                                        {{--                                        x-data="{ loading: false }"--}}
                                        {{--                                        @click="loading = true; $dispatch('add-to-cart');"--}}
                                        {{--                                        x-on:cart-updated.window="console.log('Added to cart'); loading = false;"--}}
                                        {{--                                        href="#quick_add"--}}
                                        {{--                                        data-bs-toggle="modal"--}}
                                        class="box-icon quick-add tf-btn-loading">
                                        {{--                                        :class="{ 'loading': loading }">--}}
                                        <span class="icon icon-bag"></span>
                                        <span class="tooltip">Add to cart</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /Popular product -->

    {{--    <!-- Iconbox -->--}}
    {{--    <section>--}}
    {{--        <div class="container">--}}
    {{--            <div class="bg-yellow-10 radius-20 flat-wrap-iconbox">--}}
    {{--                <div class="flat-title lg">--}}
    {{--                    <p class="sub-title fw-6">WHAT IS PLANTBELLY?</p>--}}
    {{--                    <span class="title fw-6 text-center">Plant-based groceries, delivered.</span>--}}
    {{--                </div>--}}
    {{--                <div class="flat-iconbox-v3 lg">--}}
    {{--                    <div class="wrap-carousel wrap-mobile">--}}
    {{--                        <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">--}}
    {{--                            <div class="swiper-wrapper wrap-iconbox lg">--}}
    {{--                                <div class="swiper-slide">--}}
    {{--                                    <div class="tf-icon-box text-center">--}}
    {{--                                        <div class="icon">--}}
    {{--                                            <i class="icon-plant"></i>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="content">--}}
    {{--                                            <div class="title">Plant-Based</div>--}}
    {{--                                            <p>Shop everyday staples, small-batch finds, and <br> community favorites.--}}
    {{--                                                From meat and seafood alternatives to snacks and candy - we’ve got your--}}
    {{--                                                fridge, freezer and pantry covered.</p>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="swiper-slide">--}}
    {{--                                    <div class="tf-icon-box text-center">--}}
    {{--                                        <div class="icon">--}}
    {{--                                            <i class="icon-deliciousness"></i>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="content">--}}
    {{--                                            <div class="title">Deliciousness</div>--}}
    {{--                                            <p>Crafted with precision and excellence, our activewear is meticulously--}}
    {{--                                                engineered using premium materials to ensure unmatched comfort and--}}
    {{--                                                durability.</p>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="swiper-slide">--}}
    {{--                                    <div class="tf-icon-box text-center">--}}
    {{--                                        <div class="icon">--}}
    {{--                                            <i class="icon-door"></i>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="content">--}}
    {{--                                            <div class="title">To your door</div>--}}
    {{--                                            <p>Designed for every body and anyone, our activewear embraces diversity--}}
    {{--                                                with a wide range of sizes and shapes, celebrating the beauty of--}}
    {{--                                                individuality.</p>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!-- /Iconbox -->--}}

    {{--    <!-- text-image -->--}}
    {{--    <section class="flat-spacing-12">--}}
    {{--        <div class="container">--}}
    {{--            <div class="tf-grid-layout md-col-2 tf-img-with-text img-text-3 img-text-3-style-2">--}}
    {{--                <div class="tf-image wow fadeInUp" data-wow-delay="0s">--}}
    {{--                    <div class="grid-img-group">--}}
    {{--                        <div class="box-img item-1 hover-img tf-image-wrap">--}}
    {{--                            <div class="img-style">--}}
    {{--                                <img class="lazyload"--}}
    {{--                                     data-src="{{ asset("assets/images/collections/img-w-text-grocery1.jpg") }}"--}}
    {{--                                     src="{{ asset("assets/images/collections/img-w-text-grocery1.jpg") }}"--}}
    {{--                                     alt="img-slider">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="box-img item-2 hover-img tf-image-wrap">--}}
    {{--                            <div class="img-style">--}}
    {{--                                <img class="lazyload"--}}
    {{--                                     data-src="{{ asset("assets/images/collections/img-w-text-grocery2.jpg") }}"--}}
    {{--                                     src="{{ asset("assets/images/collections/img-w-text-grocery2.jpg") }}"--}}
    {{--                                     alt="img-slider">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="box-img item-3 hover-img tf-image-wrap">--}}
    {{--                            <div class="img-style">--}}
    {{--                                <img class="lazyload"--}}
    {{--                                     data-src="{{ asset("assets/images/collections/img-w-text-grocery3.jpg") }}"--}}
    {{--                                     src="{{ asset("assets/images/collections/img-w-text-grocery3.jpg") }}"--}}
    {{--                                     alt="img-slider">--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="tf-content-wrap wow fadeInUp" data-wow-delay="0s">--}}
    {{--                    <p class="subheading text-uppercase fw-7">PERFECT GIFT FOR YOU</p>--}}
    {{--                    <h2 class="heading fade-item fade-item-1 fw-6">Ecomus Subscription</h2>--}}
    {{--                    <p class="desc fade-item fade-item-2">Delivered every month! Perfect for your favorite vegan or--}}
    {{--                        anyone you want <br> to introduce to the best better-for-you foods out there.</p>--}}
    {{--                    <a href="shop-default.html" class="tf-btn btn-fill animate-hover-btn btn-icon radius-60"><span>Shop collection</span><i--}}
    {{--                            class="icon icon-arrow-right"></i></a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!-- /text-image -->--}}
</div>
