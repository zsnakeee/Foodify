<?php

namespace App\Traits;

trait Wishlist
{
    public function isWished($product): bool
    {
        $wishlist = app(\App\Services\Product\Wishlist::class);
        return $wishlist->has($product);
    }
}
