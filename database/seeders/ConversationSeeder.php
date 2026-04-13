<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();

        if ($products->isEmpty() || $users->count() < 2) {
            return;
        }

        foreach ($products as $product) {
            // Randomly decide if a product has a conversation (50% chance)
            if (rand(0, 1)) {
                $buyer = $users->where('id', '!=', $product->user_id)->random();

                $conversation = Conversation::firstOrCreate([
                    'product_id' => $product->id,
                    'seller_id' => $product->user_id,
                    'buyer_id' => $buyer->id,
                ]);

                // Create some random messages (between 2 and 10)
                Message::factory(rand(2, 10))->create([
                    'conversation_id' => $conversation->id,
                ]);
            }
        }
    }
}
