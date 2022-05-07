<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'date_applied' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'job_title' => $this->faker->jobTitle,
            'post_url' => $this->faker->url,
            'salary' => $this->faker->randomFloat(2, 0, 100000),
            'status' => $this->faker->randomElement(['Sent', 'Interviewing', 'Offer', 'Expired']),
            'description' => $this->faker->text,
            'user_id' => 1,
            'contract_type' => $this->faker->randomElement(['full-time', 'part-time', 'temporary', 'contract']),
        ];
    }
}
