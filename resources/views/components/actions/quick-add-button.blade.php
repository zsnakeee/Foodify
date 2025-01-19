@props(['product'])

<div class="box-icon bg_white quick-add tf-btn-loading"
     x-data="cartHandler({{ $product->id }}, {{ $product->priceConverted }})"
     x-on:click="addToCart"
     x-on:cart-updated.window="$dispatch('open-cart')">
    <span class="icon icon-bag"></span>
    <span class="tooltip">{{ __('Quick Add') }}</span>
</div>
