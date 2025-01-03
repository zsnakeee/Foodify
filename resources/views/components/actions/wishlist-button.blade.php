@props(['product'])

<div class="box-icon bg_white wishlist btn-icon-action tf-btn-loading"
     x-data="wishlistHandler({{ $product->id }}, {{ $product->isWished() ? 'true' : 'false' }})"
     x-on:click="toggleWishlist"
     x-on:wishlist-updated.window="wishlistUpdated;"
     :class="{ 'loading': loading, 'active': isWished }">

    <span class="icon icon-heart" x-show="!isWished && !loading"></span>
    <span class="icon icon-delete" x-show="isWished && !loading"></span>
    <span class="tooltip"
          x-text="isWished ? '{{ __('Remove from Wishlist') }}' : '{{ __('Add to Wishlist') }}'"></span>
</div>
