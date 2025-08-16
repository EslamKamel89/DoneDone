<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'user_id' => User::factory(), // Creates a user if not given
        ];
    }
    public function completed(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
        ]);
    }

    public function pending(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
