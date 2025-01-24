<?php

use App\Livewire\Frontend\Pages\WishlistPage;
use App\Models\Product;
use App\Services\Cart\ExtendedCart;
use Livewire\Livewire;

beforeEach(function () {
    $this->products = Product::factory()->count(3)->create();
    $this->cart = app(ExtendedCart::class);
    expect($this->cart->wishlist()->all())->toBeEmpty();

    foreach ($this->products as $product) {
        $this->cart->wishlist()->add($product);
    }
});

it('returns correct view with products on render', function () {
    Livewire::test(WishlistPage::class)
        ->assertViewHas('products')
        ->assertSee($this->products->first()->name)
        ->assertSee($this->products->last()->name);
});
