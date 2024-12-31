<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Models\Product;
use App\Services\Product\Cart;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Cart')]
class Index extends Component
{
    public function render(Cart $cartService)
    {
        $cart = $cartService->all();
        $products = Product::whereIn('id', array_keys($cart))->get()
            ->unique()
            ->map(function ($product) use ($cart) {
                $product->cart_quantity = $cart[$product->id]['quantity'];
                return $product;
            });

//        dd($products);


        return view('livewire.frontend.pages.cart.index')->with(compact('products'));
    }
}
