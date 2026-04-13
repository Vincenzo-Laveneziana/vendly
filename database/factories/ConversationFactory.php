<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        
        return [
            'product_id' => $product->id,
            'seller_id' => $product->user_id,
            'buyer_id' => User::where('id', '!=', $product->user_id)->inRandomOrder()->first()?->id ?? User::factory()->create()->id,
        ];
    }
}
