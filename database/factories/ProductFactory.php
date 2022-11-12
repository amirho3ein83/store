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
        $price = $this->faker->numberBetween(12, 820);

        return [
            'title' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(5),
            'price' => $price,
            'sale_price' => $price - rand(5, 35),
            'sold_qty' => rand(144, 254),
            'balance' => rand(10, 30),
            'rate' => mt_rand(10, 50) / 10,
            'reviews' => rand(10, 30),
            'category_id' => rand(1,10)
        ];
    }
}
