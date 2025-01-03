<?php

use App\Models\Product;
use App\Models\User;
use App\Services\Product\Wishlist;

it('can add product to wishlist using session', function () {
    $product = Product::factory()->create();
    $wishlistService = new Wishlist;
    $wishlistService->add($product);
    expect(session('wishlist'))->toContain($product->id);
});

it('can get products from wishlist using session', function () {
    $product = Product::factory()->create();
    $wishlistService = new Wishlist;
    $wishlistService->add($product);
    expect($wishlistService->get())->toContain($product->id);
});

it('can add product to wishlist using database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $this->actingAs($user);

    $wishlistService = new Wishlist;
    $wishlistService->add($product);
    expect($wishlistService->get())->toContain($product->id);
});

it('can get products from wishlist using database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    auth()->login($user);
    $wishlistService = new Wishlist;
    $wishlistService->add($product);
    expect($wishlistService->get())->toContain($product->id);
});

it('can migrate wishlist from session to database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $wishlistService = new Wishlist;
    $wishlistService->add($product);
    $this->actingAs($user);
    $wishlistService->migrate();
    expect($wishlistService->get())->toContain($product->id);
});
