<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $categories = Product::categories();
        $categoryIds = array_keys($categories);

        return [
            'user_id' => User::factory(),
            'category' => fake()->randomElement($categoryIds),
            'title' => 'iPhone 15 Pro Max 256GB - Ottime condizioni',
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 5, 1000),
            'sold_at' => fake()->optional(0.2)->dateTime(),
        ];
    }
}
