<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Marketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraphs(2, true),
            'marketplace_id' => Marketplace::factory(),
            'image' => null,
            'price' => fake()->randomFloat(2, 10, 1000),
        ];
    }
} 