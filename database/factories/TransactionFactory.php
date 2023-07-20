<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'item' => fake()->word(),
            'quantity' => fake()->randomNumber(3, false),
            'amount' => fake()->randomFloat(2, 100, 1000),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
//        return $this->state(fn (array $attributes) => [
//            'email_verified_at' => null,
//        ]);
    }
}
