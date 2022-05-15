<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'job_id' => $this->faker->numberBetween(1, 10),
            'description' =>  $this->faker->sentence,
            'completed' => $this->faker->boolean,
        ];
    }
}
