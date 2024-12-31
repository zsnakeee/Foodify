@props(['product'])

<a href="javascript:void(0);"
   class="box-icon bg_white wishlist btn-icon-action tf-btn-loading"
   x-data="wishlistHandler({{ $product->id }}, {{ $product->isWished() ? 'true' : 'false' }})"
   x-on:click="toggleWishlist"
   x-on:wishlist-updated.window="wishlistUpdated"
   :class="{ 'loading': loading, 'active': isWished }"
>
    <span x-show="!isWished" class="icon icon-heart"></span>
    <span x-show="isWished" class="icon icon-delete"></span>
    <span class="tooltip" x-text="isWished ? 'Remove from Wishlist' : 'Add to Wishlist'"></span>
</a>
