<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            // Each user creates between 1 and 5 products
            Product::factory(rand(1, 5))->create([
                'user_id' => $user->id,
            ])->each(function ($product) {
                // Each product gets 1 to 3 images
                Image::factory(rand(1, 3))->create([
                    'product_id' => $product->id,
                ]);
            });
        }
    }
}
