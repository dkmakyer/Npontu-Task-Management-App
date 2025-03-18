<?php

namespace Database\Factories;

use App\Models\Task;
use Carbon\Carbon;
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
    protected $modelName = Task::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(9),
            'description' => $this->faker->sentence(50),
            'user_id' => $this->faker->randomElement([1, 2]),
            'due_date' => Carbon::tomorrow(),
            'category' => $this->faker->randomElement(['Educational', 'Health and Fitness']),
            'priority' => $this->faker->randomElement(['medium', 'low', 'high'])
        ];
    }
}
