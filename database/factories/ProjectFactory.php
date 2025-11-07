<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name'=>fake()->catchPhrase(3),
            'description'=>fake()->realText(),
            'owner_id'=>User::factory(),
        ];
    }
}
