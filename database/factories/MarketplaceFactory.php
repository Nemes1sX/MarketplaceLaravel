<?php

namespace Database\Factories;

use App\Models\Marketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketplaceFactory extends Factory
{
    protected $model = Marketplace::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'name' => $title,
            'slug' => str()->slug($title),
            'short_description' => fake()->sentence(8),
            'description' => fake()->paragraphs(3, true),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'image' => null,
            'user_id' => \App\Models\User::factory()
        ];
    }
} 