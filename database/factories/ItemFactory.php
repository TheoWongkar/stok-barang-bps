<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-###')),
            'stock' => fake()->numberBetween(10, 100),
            'unit' => fake()->randomElement(['pcs', 'kg', 'ltr']),
        ];
    }
}
