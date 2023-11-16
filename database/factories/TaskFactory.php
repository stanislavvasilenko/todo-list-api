<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_id' => 1,
            'priority_id' => Priority::get()->random()->id,
            'title' => fake()->sentence(),
            'description' => fake()->text(),
        ];
    }
}
