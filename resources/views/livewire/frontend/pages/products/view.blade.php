<div>
    <section class="flat-spacing-4 pt_0">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                                     data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        @foreach($product->gallery_urls as $image)
                                            <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img class="lazyload" data-src="{{ $image }}"
                                                         src="{{ $image }}" alt="{{ $product->name }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        @foreach($product->gallery_urls as $image)
                                            <div class="swiper-slide">
                                                <a href="{{ $image }}"
                                                   target="_blank"
                                                   class="item"
                                                   data-pswp-width="770px"
                                                   data-pswp-height="1075px"
                                                >
                                                    <img class="tf-image-zoom lazyload" style="object-fit: none"
                                                         data-zoom="{{ $image }}"
                                                         data-src="{{ $image }}"
                                                         src="{{ $image }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5>{{ $product->name }}</h5>
                                </div>
                                <div class="tf-product-info-badges">
                                    <div class="badges">Best seller</div>
                                    <div @class(['product-status-content', 'd-none' => $holdersCount < 10])>
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">{{ __('Selling fast! :count people have this in their carts.', ['count', $holdersCount]) }}</p>
                                    </div>
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale">{{ $product->formatted_price }}</div>
                                    {{--                                    <div class="compare-at-price">$30.00</div>--}}
                                    {{--                                    <div class="badges-on-sale"><span>20</span>% OFF</div>--}}
                                </div>
                                <div class="tf-product-info-liveview">
                                    <div class="liveview-count">20</div>
                                    <p class="fw-6">People are viewing this right now</p>
                                </div>

                                <div class="tf-product-info-countdown">
                                    <div class="countdown-wrap">
                                        <div class="countdown-title">
                                            <i class="icon-time tf-ani-tada"></i>
                                            <p>HURRY UP! SALE ENDS IN:</p>
                                        </div>
                                        <div class="tf-countdown style-1">
                                            <div class="js-countdown" data-timer="1007500"
                                                 data-labels="Days :,Hours :,Mins :,Secs"></div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-bottom: 30px"
                                     x-data="cartHandler({{ $product->id }}, {{ $product->price }})">
{{--                                     x-on:cart-updated.window="cartUpdated">--}}
                                    <div class="tf-product-info-quantity" style="margin-bottom: 30px">
                                        <div class="quantity-title fw-6">Quantity</div>
                                        <div class="wg-quantity">
                                            <span class="btn-quantity btn-decrease" x-on:click="decrement">-</span>
                                            <input type="text" class="quantity-product" name="number" value="1"
                                                   x-model="quantity">
                                            <span class="btn-quantity btn-increase" x-on:click="increment">+</span>
                                        </div>
                                    </div>
                                    <div class="tf-product-info-buy-button" style="margin-bottom: 30px">
                                        <form>
                                            <div x-on:click="addToCart"
                                                 class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart">
                                                <span>{{ __('Add to cart') }} -&nbsp;</span>
                                                <span class="tf-qty-price total-price" x-text="formattedPrice"></span>
                                            </div>
                                            <div
                                                x-data="wishlistHandler({{ $product->id }}, {{ $product->isWished() ? 'true' : 'false' }})"
                                                x-on:click="toggleWishlist"
                                                x-on:wishlist-updated.window="wishlistUpdated"
                                                :class="{ 'active': isWished }"
                                                class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist tf-btn-loading">
                                                <span x-show="loading" class="spinner-border spinner-border-sm"></span>
                                                <span class="icon icon-heart" x-show="!isWished && !loading"></span>
                                                <span class="icon icon-delete" x-show="isWished && !loading"></span>
                                                <span class="tooltip"
                                                      x-text="isWished ? '{{ __('Remove from Wishlist') }}' : '{{ __('Add to Wishlist') }}'"></span>
                                            </div>

                                            <div class="w-100">
                                                <a href="#" class="btns-full">{{ __('Buy Now') }}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="tf-product-info-delivery-return">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>Estimate delivery times: <span class="fw-7">12-26 days</span>
                                                    (International), <span class="fw-7">3-6 days</span> (United
                                                    States).</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>Return within <span class="fw-7">30 days</span> of purchase.
                                                    Duties & taxes are non-refundable.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-product-info-trust-seal">
                                    <div class="tf-product-trust-mess">
                                        <i class="icon-safe"></i>
                                        <p class="fw-6">Guarantee Safe <br> Checkout</p>
                                    </div>
                                    <div class="tf-payment">
                                        <img src="{{ asset('assets/images/payments/visa.png') }}" alt="">
                                        <img src="{{ asset('assets/images/payments/img-1.png') }}" alt="">
                                        <img src="{{ asset('assets/images/payments/img-2.png') }}" alt="">
                                        <img src="{{ asset('assets/images/payments/img-3.png') }}" alt="">
                                        <img src="{{ asset('assets/images/payments/img-4.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- recent -->
    <section class="flat-spacing-4 pt_0" @class(['d-none' => count($recentProducts) == 0])>
        <div class="container">
            <div class="flat-title">
                <span class="title">{{ __('Recently Viewed') }}</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div dir="ltr" class="swiper tf-sw-recent wrap-sw-over"
                     data-preview="4" data-tablet="3" data-mobile="2"
                     data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1"
                     data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        @foreach($recentProducts as $product)
                            <div class="swiper-slide" lazy="true">
                                <x-card.product :product="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round">
                    <span class="icon icon-arrow-left"></span>
                </div>
                <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round">
                    <span class="icon icon-arrow-right"></span>
                </div>
                <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
            </div>
        </div>
    </section>
    <!-- /recent -->
</div>
