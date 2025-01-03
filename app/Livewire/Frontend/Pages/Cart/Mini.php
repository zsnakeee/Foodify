<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Models\Product;
// use App\Services\Product\Cart;
use App\Services\Cart\ExtendedCart;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Number;

class Mini extends Component
{
    public $products = [];

    public $total = 0;

    public function render(ExtendedCart $cart)
    {
        $this->products = $cart->shopping()->products();
        $this->total = $cart->shopping()->totalFloat();

        return view('livewire.frontend.pages.cart.mini');
    }

    #[On('cart-add')]
    public function addToCart(ExtendedCart $cart, $id = null, $quantity = null): void
    {
        try {
            $product = Product::findOrFail($id);
            $cart->shopping()->add($product, qty: $quantity);
            $this->fireCartUpdatedEvent($cart, $id);
            Toaster::success(__('Product added to cart'));
        } catch (Exception $e) {
            Toaster::error(__('Something went wrong'));
        }
    }

    #[On('cart-update')]
    public function updateCart(ExtendedCart $cart, $id = null, $quantity = null): void
    {
        try {
            $product = Product::findOrFail($id);
            $cart->shopping()->update($product, qty: $quantity);
            $this->fireCartUpdatedEvent($cart, $id);
            Toaster::success(__('Cart updated'));
        } catch (Exception $e) {
            Toaster::error(__('Something went wrong'));
        }
    }

    protected function fireCartUpdatedEvent(ExtendedCart $cart, $id = null): void
    {
        $this->dispatch('cart-updated',
            id: $id,
            products: $cart->shopping()->products(),
            total: $cart->shopping()->totalFloat(),
            subTotal: $cart->shopping()->priceTotalFloat(),
            discount: $cart->shopping()->discountFloat(),
        );
    }

    #[On('wishlist-toggle')]
    public function toggleWishlist(ExtendedCart $cart, $id = null): void
    {
        try {
            $product = Product::findOrFail($id);
            if ($cart->wishlist()->has($product)) {
                $cart->wishlist()->remove($product);
                Toaster::info(__('Product removed from wishlist'));
            } else {
                $cart->wishlist()->add($product);
                Toaster::success(__('Product added to wishlist'));
            }

            $this->dispatch('wishlist-updated', id: $id);
        } catch (Exception $e) {
            Toaster::error(__('Product not found'));
        }
    }
}
