<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isFeatured = $this->faker->boolean;
        $isBest = $this->faker->boolean;

        return [
            'brand_id' => Brand::pluck('id')->random(),
            'category_id' => Category::pluck('id')->random(),
            'name' => $this->faker->name,
            'code' => Str::random(5),
            'description' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'image' => "products/food{$this->faker->numberBetween(1, 7)}.jpg",
            'gallery' => [$this->faker->imageUrl(), $this->faker->imageUrl()],
            'quantity' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(0, 20, 250),
            'is_active' => true,
            'is_new' => $this->faker->boolean,
            'is_featured' => $isFeatured,
            'is_best' => $isBest,
            'is_hot' => $this->faker->boolean,
        ];
    }

    //    private function image($trending, $featured): string
    //    {
    //        if ($trending)
    //            return "products/trending-product-{$this->faker->numberBetween(1, 5)}.png";
    //        if ($featured)
    //            return "products/feature-product-{$this->faker->numberBetween(1, 14)}.png";
    //
    //        return "products/product-{$this->faker->numberBetween(1, 7)}.png";
    //    }

}
