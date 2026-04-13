<?php

namespace Database\Factories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conversation = Conversation::inRandomOrder()->first() ?? Conversation::factory()->create();
        
        return [
            'conversation_id' => $conversation->id,
            'sender_id' => fake()->randomElement([$conversation->seller_id, $conversation->buyer_id]),
            'content' => fake()->sentence(),
        ];
    }
}
