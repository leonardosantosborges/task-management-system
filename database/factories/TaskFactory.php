<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
