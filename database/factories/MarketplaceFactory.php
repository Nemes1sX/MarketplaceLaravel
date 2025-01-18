<?php

namespace Database\Factories;

use App\Models\Marketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketplaceFactory extends Factory
{
    protected $model = Marketplace::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(3),
            'description' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'image' => null,
            'user_id' => \App\Models\User::factory()
        ];
    }
} 