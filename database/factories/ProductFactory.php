<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->text(10);
        $price = $this->faker->numberBetween(100, 900);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(100),
            'price' => $price,
            'sale_price' => $price - 50,
            'balance' => rand(10, 30),
        ];
    }
}
