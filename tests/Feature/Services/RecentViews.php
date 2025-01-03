<?php

use App\Models\Product;
use App\Models\User;
use App\Services\Product\RecentViews;

it('can add product to recent views using session', function () {
    $product = Product::factory()->create();
    $recentViewsService = new RecentViews;
    $recentViewsService->add($product);
    expect(session('recentViews'))->toContain($product->id);
});

it('can get products from recent views using session', function () {
    $product = Product::factory()->create();
    $recentViewsService = new RecentViews;
    $recentViewsService->add($product);
    expect($recentViewsService->get())->toContain($product->id);
});

it('can add product to recent views using database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $this->actingAs($user);

    $recentViewsService = new RecentViews;
    $recentViewsService->add($product);
    expect($recentViewsService->get())->toContain($product->id);
});

it('can get products from recent views using database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    auth()->login($user);
    $recentViewsService = new RecentViews;
    $recentViewsService->add($product);
    expect($recentViewsService->get())->toContain($product->id);
});

it('can migrate recent views from session to database', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $recentViewsService = new RecentViews;
    $recentViewsService->add($product);
    $this->actingAs($user);
    $recentViewsService->migrate();
    expect($recentViewsService->get())->toContain($product->id);
});
