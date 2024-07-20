<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'completed', 'overdue']),
            'person_assigned' => fake()->numberBetween(1, 10),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
