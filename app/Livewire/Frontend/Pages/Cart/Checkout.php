<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]

class Checkout extends Component
{
    public $products = [];

    public float $total;

    public float $discount;

    public float $priceTotal;

    public function mount(): void
    {
        $cart = app(ExtendedCart::class)->shopping();
        $this->products = $cart->products();
        $this->total = $cart->totalFloat();
        $this->discount = $cart->discountFloat();
        $this->priceTotal = $cart->priceTotalFloat();
    }

    public function render()
    {
        return view('livewire.frontend.pages.cart.checkout')
            ->layoutData([
                'title' => __('Checkout'),
                'pageTitle' => __('Checkout'),
                'breadcrumbs' => [
                    __('Home') => route('home'),
                    __('Checkout') => null,
                ],
            ]);
    }
}
