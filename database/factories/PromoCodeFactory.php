<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromoCode>
 */
class PromoCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(10),
            'type' => 'percentage',
            'value' => $this->faker->randomFloat(2, 0, 100),
            'start_at' => now(),
            'end_at' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'is_active' => $this->faker->boolean,
            'usage_limit' => $this->faker->randomNumber(2),
            'usage_count' => 0,
            'usage_per_user' => $this->faker->randomNumber(1),
        ];
    }
}
