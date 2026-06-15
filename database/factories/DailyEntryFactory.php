<?php

namespace Database\Factories;

use App\Models\DailyEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyEntryFactory extends Factory
{
    protected $model = DailyEntry::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'entry_date' => fake()->date(),
            'hours_creative_work' => fake()->numberBetween(0, 24),
            'quality_score' => fake()->numberBetween(-2, 2),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
