<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {   

        //For Demo purposes - Example User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->projects()->createMany(
            Project::factory(7)->make()->toArray()
        );
        $projects = $admin->projects()->get();

        foreach ($projects as $project) {
            $project->tasks()->createMany(
                Task::factory(30)->make()->map(function ($task) use ($admin) {
                $task->assigned_to = User::inRandomOrder()->first()->id;
                return $task->toArray();
            })->toArray()
            );
        }


        User::factory(10)
        ->has(
            Project::factory(rand(2,5))
                ->has(
                Task::factory(rand(3,8))
                    ->state(fn (array $attributes, Project $project) => [
                        'assigned_to' => User::inRandomOrder()->first()->id,
                    ])
                )
        )
        ->create();
    }
}
