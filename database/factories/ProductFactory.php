<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Marketplace;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'marketplace_id' => Marketplace::factory(),
            'image' => null,
            'price' => fake()->randomFloat(2, 10, 1000),
        ];
    }
} 