<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::updateOrCreate(
            ['email' => 'admin@vendly.it'],
            [
                'name' => 'Admin',
                'surname' => 'User',
                'password' => 'admin12345',
                'is_admin' => 1,
                'date_of_birth' => '1990-01-01',
                'phone' => '0000000000',
                'address' => [
                    'street' => 'Via Roma 1',
                    'city' => 'Roma',
                    'state' => 'RM',
                    'zip' => '00100',
                ],
            ]
        );

        // Create random users
        User::factory(10)->create();
    }
}
