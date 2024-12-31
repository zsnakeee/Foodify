<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Models\Product;
use App\Services\Product\Cart;
use App\Services\Product\Wishlist;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Mini extends Component
{
    public function render()
    {
        return view('livewire.frontend.pages.cart.mini');
    }

    #[On('cart-update')]
    public function updateCart(Cart $cartService, $id, $quantity): void
    {
        try {
            $product = Product::findOrFail($id);
            $cartService->add($product, $quantity);
            $this->dispatch('cart-updated', id: $id);
            Toaster::success(__('Cart updated'));
        } catch (Exception $e) {
            Toaster::error(__('Product not found'));
        }
    }

    #[On('removeFromCart')]
    public function removeFromCart($product)
    {

    }


    #[On('clearCart')]
    public function clearCart()
    {

    }


    #[On('add-to-wishlist')]
    public function addToWishlist(Wishlist $wishlist, $id = null): void
    {
        try {
            $product = Product::findOrFail($id);
            $wishlist->add($product);
            $this->dispatch('wishlist-added', id: $id);
        } catch (Exception $e) {
            Toaster::error('Product not found');
        }
    }

    #[On('remove-from-wishlist')]
    public function removeFromWishlist(Wishlist $wishlist, $id = null): void
    {
        try {
            $product = Product::findOrFail($id);
            $wishlist->remove($product);
            $this->dispatch('wishlist-removed', id: $id);
        } catch (Exception $e) {
            Toaster::error('Product not found');
        }
    }

    #[On('toggle-wishlist')]
    public function toggleWishlist(Wishlist $wishlist, $id = null): void
    {
        try {
            $product = Product::findOrFail($id);
            $isWished = $wishlist->has($product);

            if ($isWished) {
                $wishlist->remove($product);
                Toaster::info(__('Product removed from wishlist'));
            } else {
                $wishlist->add($product);
                Toaster::success(__('Product added to wishlist'));
            }

            $this->dispatch('wishlist-updated', id: $id);
        } catch (Exception $e) {
            Toaster::error(__('Product not found'));
        }
    }


}
