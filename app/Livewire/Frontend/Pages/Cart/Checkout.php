<?php

namespace App\Livewire\Frontend\Pages\Cart;

use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]

class Checkout extends Component
{
    protected $title;

    public $products = [];

    public float $total;

    public float $discount;

    public float $priceTotal;

    public bool $single = false;

    public function __construct()
    {
        $this->cart = app(ExtendedCart::class)->shopping();
    }

    public function mount($single = false): void
    {
        $this->title = __('Checkout');
        $this->single = boolval($single);
        if (! $single) {
            $this->products = $this->cart->products();
        } else {
            $this->products = $this->cart->instance('single')->products();
        }

        $this->total = $this->cart->totalFloat();
        $this->discount = $this->cart->discountFloat();
        $this->priceTotal = $this->cart->priceTotalFloat();
    }

    public function render()
    {
        return view('livewire.frontend.pages.cart.checkout')
            ->layoutData([
                'title' => $this->title,
                'pageTitle' => $this->title,
                'breadcrumbs' => [
                    __('Home') => route('home'),
                    __('Checkout') => null,
                ],
            ]);
    }
}
