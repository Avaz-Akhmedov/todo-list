<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(100),
            'description' => $this->faker->realTextBetween(100),
            'status' => $this->faker->randomElement(['active', 'completed']),
        ];
    }
}
