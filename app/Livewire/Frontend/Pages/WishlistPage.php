<?php

namespace App\Livewire\Frontend\Pages;

use App\Services\Cart\ExtendedCart;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class WishlistPage extends Component
{
    public $title = 'Wishlist';

    public function mount(): void
    {
        $this->title = __('Wishlist');
    }

    public function render(ExtendedCart $cart)
    {
        $products = $cart->wishlist()->products();
        return view('livewire.frontend.pages.wishlist-page', compact('products'))->layoutData([
            'title' => $this->title,
            'pageTitle' => $this->title,
            'breadcrumbs' => [
                __('Home') => route('home'),
                $this->title => null,
            ],
        ]);

    }
}
