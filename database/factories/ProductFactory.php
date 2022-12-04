<?php

namespace Database\Factories;

use App\Models\Category;
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



        $skus = [
            1 => 'BD1249229',
            2 => 'SD2534234',
            3 => 'TN2345245',
            4 => 'KJ5453454',
            5 => 'PL2345345',
            6 => 'RE2524523',
            7 => 'ED4534442',
        ];

        $skus[array_rand($skus)];


        $title = Str::random(6) . '-کالا';
        $price = mt_rand(5, 120);
        $price *= 1000;

        $categoryIds = Category::whereNotNull('parent_id')->pluck('id')->toArray();

        return [
            'title' => $title,
            'category_id' => $categoryIds[array_rand($categoryIds)],
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence(40),
            'details' => $this->faker->sentence(8),
            'default_price' => $price,
            'sold_qty' => rand(144, 254),
            'stock' => rand(10, 30),
            'rate' => mt_rand(10, 50) / 10,
            'reviews' => rand(10, 30),
            'sku' => $skus[array_rand($skus)]
        ];
    }
}
