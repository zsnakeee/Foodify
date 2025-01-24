<?php

use App\Livewire\Frontend\Pages\HomePage;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;


it('renders the home page correctly', function () {
    Livewire::test(HomePage::class)
        ->assertViewIs('livewire.frontend.pages.home-page')
        ->assertOk();
});

it('fetches categories correctly', function () {
    Category::factory()->count(5)->create();
    $count = Category::count();

    Livewire::test(HomePage::class)
        ->assertCount('categories', $count);
});

it('fetches popular categories correctly', function () {
    Category::factory()->count(3)->create(['is_popular' => 1]);
    $count = Category::where('is_popular', 1)->count();

    Livewire::test(HomePage::class)
        ->assertCount('popularCategories', $count);
});

it('fetches most discounted categories correctly', function () {
    Category::factory()->count(2)->create(['discount' => 50]);
    $count = Category::where('discount', '>', 0)->count();

    Livewire::test(HomePage::class)
        ->assertCount('mostDiscountedCategories', $count);
});

it('fetches featured products correctly', function () {
    Product::factory()->count(8)->create(['is_featured' => 1]);
    $count = Product::where('is_featured', 1)->count();

    Livewire::test(HomePage::class)
        ->assertCount('featuredProducts', $count);
});

it('fetches banners correctly', function () {
    Banner::factory()->count(4)->create(['is_active' => 1]);

    Livewire::test(HomePage::class)
        ->assertCount('banners', 4);
});
