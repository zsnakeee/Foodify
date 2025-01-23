<?php

it('fetch products', function () {
    $products = \App\Models\Product::factory(5)->create();
    $response = $this->getJson('/api/products');
    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'image',
                    'price',
                    'created_at',
                ],
            ],
        ]);
});

it('fetch single product', function () {
    $product = \App\Models\Product::factory()->create();
    $response = $this->getJson("/api/products/{$product->id}");
    $response->assertOk()
        ->assertJson([
            'data' => [
                'name' => $product->getTranslations('name'),
                'description' => $product->getTranslations('description'),
                'image' => asset($product->image_url),
                'price' => $product->price,
                'created_at' => $product->created_at->format('Y-m-d'),
            ],
        ]);
});

it('fetch products by category', function () {
    $category = \App\Models\Category::factory()->create();
    $products = \App\Models\Product::factory(5)->create();
    $products->each(fn ($product) => $product->category()->associate($category)->save());
    $response = $this->getJson("/api/products?category={$category->slug}");
    $response->assertOk()
        ->assertJson([
            'data' => [
                [
                    'category' => $category->getTranslations('name'),
                ],
            ],
        ])
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'image',
                    'price',
                    'created_at',
                ],
            ],
        ]);
});

it('fetch products by brand', function () {
    $brand = \App\Models\Brand::factory()->create();
    $products = \App\Models\Product::factory(5)->create();
    $products->each(fn ($product) => $product->brand()->associate($brand)->save());

    $response = $this->getJson("/api/products?brand={$brand->slug}");
    $response->assertOk()
        ->assertJson([
            'data' => [
                [
                    'brand' => $brand->getTranslations('name'),
                ],
            ],
        ])
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'image',
                    'price',
                    'created_at',
                ],
            ],
        ]);
});

it('fetch active products', function () {
    $products = \App\Models\Product::factory(5)->create(['is_active' => true]);
    $response = $this->getJson('/api/products?active=true');
    $response->assertOk()
        ->assertJson([
            'data' => [
                [
                    'is_active' => true,
                ],
            ],
        ])
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'image',
                    'price',
                    'created_at',
                ],
            ],
        ]);
});
