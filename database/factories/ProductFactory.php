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
        $title = fake()->words(3, true);

        return [
            'name' => $title,
            'slug' => str()->slug($title),
            'description' => fake()->paragraphs(2, true),
            'marketplace_id' => Marketplace::factory(),
            'image' => null,
            'price' => fake()->randomFloat(2, 10, 1000),
        ];
    }
} 