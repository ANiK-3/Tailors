<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '12345678',
            'phone' => '+8801' . $this->faker->numberBetween(100000000, 999999999),
            'gender_id' => fake()->randomElement([1, 2]),
            'address' => fake()->address(),
            'email_verified_at' => now(),
        ];
    }
}
