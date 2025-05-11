<?php

namespace Database\Factories;

use App\Models\Marketplace;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketplaceFactory extends Factory
{
    protected $model = Marketplace::class;

    public function definition(): array
    {
        $name = fake()->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'image' => null,
            'user_id' => \App\Models\User::factory()
        ];
    }
} 