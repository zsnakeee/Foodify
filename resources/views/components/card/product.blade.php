@props([
    'product' => null,
 ])

<div class="card-product visible" {{ $attributes }}>
    <div class="card-product-wrapper">
        <a wire:navigate href="{{ route('products.view', $product) }}" class="product-img">
            <img class="lazyload img-product" data-src="{{ $product->image_url }}"
                 src="{{ $product->image_url }}" alt="{{ $product->name }}">
            <img class="lazyload img-hover" data-src="{{ $product->image_url }}"
                 src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </a>
        <div class="list-product-btn absolute-2">
            <div class="box-icon bg_white quick-add tf-btn-loading"
                 x-data="cartHandler({{ $product->id }}, {{ $product->price }})"
                 x-on:click="increment(); updateCart();"
                 x-on:cart-updated.window="cartUpdated">
                <span class="icon icon-bag"></span>
                <span class="tooltip">Quick Add</span>
            </div>

            <div class="box-icon bg_white wishlist"
                 x-data="wishlistHandler({{ $product->id }}, {{ $product->isWished() ? 'true' : 'false' }})"
                 x-on:click="toggleWishlist"
                 x-on:wishlist-updated.window="wishlistUpdated"
                 :class="{ 'loading': loading, 'active': isWished }">
                <span x-show="!isWished" class="icon icon-heart"></span>
                <span x-show="isWished" class="icon icon-delete"></span>
                <span class="tooltip"
                      x-text="isWished ? '{{ __('Remove from Wishlist') }}' : '{{ __('Add to Wishlist') }}'"></span>
            </div>

            <div class="box-icon bg_white quickview tf-btn-loading"
                 x-data="{ product: {{ $product->attributesForQuickView() }} }"
                 x-on:click="$dispatch('quick-view', product)">
                <span class="icon icon-view"></span>
                <span class="tooltip">Quick View</span>
            </div>
        </div>
    </div>
    <div class="card-product-info">
        <a href="product-detail.html" class="title link">{{ $product->name }}</a>
        <span class="price">{{ $product->formatted_price }}</span>
        {{--                                <ul class="list-color-product">--}}
        {{--                                    <li class="list-color-item color-swatch active">--}}
        {{--                                        <span class="tooltip">Orange</span>--}}
        {{--                                        <span class="swatch-value bg_orange-3"></span>--}}
        {{--                                        <img class="lazyload" data-src="images/products/orange-1.jpg" src="images/products/orange-1.jpg" alt="image-product">--}}
        {{--                                    </li>--}}
        {{--                                    <li class="list-color-item color-swatch">--}}
        {{--                                        <span class="tooltip">Black</span>--}}
        {{--                                        <span class="swatch-value bg_dark"></span>--}}
        {{--                                        <img class="lazyload" data-src="images/products/black-1.jpg" src="images/products/black-1.jpg" alt="image-product">--}}
        {{--                                    </li>--}}
        {{--                                    <li class="list-color-item color-swatch">--}}
        {{--                                        <span class="tooltip">White</span>--}}
        {{--                                        <span class="swatch-value bg_white"></span>--}}
        {{--                                        <img class="lazyload" data-src="images/products/white-1.jpg" src="images/products/white-1.jpg" alt="image-product">--}}
        {{--                                    </li>--}}
        {{--                                </ul>--}}
    </div>
</div>
