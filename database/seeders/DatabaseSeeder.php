<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Marketplace;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create regular users with marketplaces
        User::factory(5)->create()->each(function ($user) {
            // Create one marketplace listing for each user
            Marketplace::factory()->create([
                'user_id' => $user->id
            ])->each(function ($marketplace) {
                Product::factory(25)->create([
                    'marketplace_id' => $marketplace->id
                ]);
            });
        });
    }
}
