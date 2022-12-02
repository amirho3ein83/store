<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $suggestions = [
            1 => 'yes',
            2 => 'no',
            3 => 'not_sure'
        ];

        return [
            'product_id' => rand(1, 20),
            'body' => $this->faker->sentence(12),
            'suggestion' => $suggestions[array_rand($suggestions)]
        ];
    }
}
