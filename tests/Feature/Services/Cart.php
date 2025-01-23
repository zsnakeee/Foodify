<?php

use App\Models\Product;
use App\Services\Cart\ExtendedCart;

it('adds to recently viewed on visit', function () {
    $cart = app(ExtendedCart::class);

    expect($cart->recentViews()->content()->count())
        ->toBe(0);

    $product = Product::factory()->create();

    Livewire::test(App\Livewire\Frontend\Pages\Products\View::class, [$product->slug])
        ->assertStatus(200);

    expect($cart->recentViews()->content()->count())
        ->toBe(1)
        ->and($cart->products()->first())
        ->id
        ->toBe($product->id);
});

it('add product to wishlist', function () {
    $cart = app(ExtendedCart::class);

    expect($cart->wishlist()->content()->count())
        ->toBe(0);

    $product = Product::factory()->create();

    Livewire::test(App\Livewire\Frontend\Pages\Cart\Mini::class)
        ->call('toggleWishlist', $product->id)
        ->assertDispatched('wishlist-updated');

    expect($cart->wishlist()->content()->count())
        ->toBe(1)
        ->and($cart->products()->first())
        ->id
        ->toBe($product->id);
});

it('add product to cart', function () {
    $cart = app(ExtendedCart::class);

    expect($cart->shopping()->content()->count())
        ->toBe(0);

    $product = Product::factory()->create();

    Livewire::test(App\Livewire\Frontend\Pages\Cart\Mini::class)
        ->call('addToCart', $product->id)
        ->assertDispatched('cart-updated');

    expect($cart->shopping()->content()->count())
        ->toBe(1)
        ->and($cart->products()->first())
        ->id->toBe($product->id);
});

it('update product in cart', function () {
    $cart = app(ExtendedCart::class)->shopping();

    expect($cart->shopping()->content()->count())
        ->toBe(0);

    $product = Product::factory()->create();

    Livewire::test(App\Livewire\Frontend\Pages\Cart\Mini::class)
        ->call('addToCart', $product->id);

    expect($cart->shopping()->content()->count())
        ->toBe(1)
        ->and($cart->products()->first())
        ->id->toBe($product->id);

    Livewire::test(App\Livewire\Frontend\Pages\Cart\Mini::class)
        ->call('updateCart', $product->id, 2)
        ->assertDispatched('cart-updated');


    expect($cart->shopping()->content()->count())
        ->toBe(1)
        ->and($cart->shopping()->products()->first())
        ->qty
        ->toBe(2);
});
