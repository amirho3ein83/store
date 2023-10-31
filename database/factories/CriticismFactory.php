<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criticism>
 */
class CriticismFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'desc' => $this->faker->sentence(5, true),
            'critic_email' => $this->faker->unique()->safeEmail(),
            'critic_name' => $this->faker->name(),
        ];
    }
}
