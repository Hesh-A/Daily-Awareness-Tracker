<?php

namespace Database\Factories;

use App\Models\CustomMetric;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomMetricFactory extends Factory
{
    protected $model = CustomMetric::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->unique()->word(),
        ];
    }
}
