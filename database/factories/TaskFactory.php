<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'=>fake()->bs(),
            'status'=>fake()->randomElement(Task::STATUS_LIST),
            'project_id'=>Project::factory(),
            'assigned_to'=>User::factory(),
            'due_date'=>Carbon::now()->addDays(rand(1, 365))->format('Y-m-d'),
        ];
    }
}
