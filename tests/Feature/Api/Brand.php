<?php

use App\Models\Brand;

it('can get all brands', function () {
    $response = $this->getJson('/api/brands');

    $response->assertStatus(200);
    $response->assertJsonStructure([
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

it('can get a brand', function () {
    $brand = Brand::factory()->create();

    $response = $this->getJson("/api/brands/{$brand->id}");

    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            'name' => $brand->getTranslations('name'),
            'description' => $brand->getTranslations('description'),
            'image' => asset($brand->image_url),
            'created_at' => $brand->created_at->format('Y-m-d'),
        ],
    ]);
});

it('can get a brand with products', function () {
    $brand = Brand::factory()->hasProducts(3)->create();

    $response = $this->getJson("/api/brands/{$brand->id}?with_products=true");

    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            'name' => $brand->getTranslations('name'),
            'description' => $brand->getTranslations('description'),
            'image' => asset($brand->image_url),
            'created_at' => $brand->created_at->format('Y-m-d'),
            'products' => $brand->products->map(function ($product) {
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

it('can get active brands', function () {
    Brand::factory()->count(3)->create(['is_active' => true]);
    $response = $this->getJson('/api/brands?active=true');
    $response->assertStatus(200);
    $response->assertJson([
        'data' => [
            [
                'is_active' => true,
            ],
        ],
    ]);
});
