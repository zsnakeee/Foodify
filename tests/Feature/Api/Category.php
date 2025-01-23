<?php

it('can get categories', function () {
    $categories = \App\Models\Category::factory(5)->create();
    $response = $this->getJson('/api/categories');
    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'image',
                    'created_at',
                ],
            ],
        ]);
});

it('can get a category', function () {
    $category = \App\Models\Category::factory()->create();
    $response = $this->getJson("/api/categories/{$category->id}");
    $response->assertOk()
        ->assertJson([
            'data' => [
                'name' => $category->getTranslations('name'),
                'description' => $category->getTranslations('description'),
                'image' => asset($category->image_url),
                'created_at' => $category->created_at->format('Y-m-d'),
            ],
        ]);
});

it('can get a category with products', function () {
    $category = \App\Models\Category::factory()->hasProducts(3)->create();
    $response = $this->getJson("/api/categories/{$category->id}?with_products=true");
    $response->assertOk()
        ->assertJson([
            'data' => [
                'name' => $category->getTranslations('name'),
                'description' => $category->getTranslations('description'),
                'image' => asset($category->image_url),
                'created_at' => $category->created_at->format('Y-m-d'),
                'products' => $category->products->map(function ($product) {
                    return [
                        'name' => $product->getTranslations('name'),
                        'description' => $product->getTranslations('description'),
                        'image' => asset($product->image_url),
                        'price' => $product->price,
                        'created_at' => $product->created_at->format('Y-m-d'),
                    ];
                })->all(),
            ],
        ]);
});

it('can get active categories', function () {
    $activeCategory = \App\Models\Category::factory()->create(['is_active' => true]);
    $inactiveCategory = \App\Models\Category::factory()->create(['is_active' => false]);
    $response = $this->getJson('/api/categories?active=true');
    $response->assertOk()
        ->assertJsonFragment([
            'name' => $activeCategory->getTranslations('name'),
        ])
        ->assertJsonMissing([
            'name' => $inactiveCategory->getTranslations('name'),
        ]);
});
