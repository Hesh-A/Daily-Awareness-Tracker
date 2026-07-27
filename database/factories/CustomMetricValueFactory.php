<?php

namespace Database\Factories;

use App\Models\CustomMetricValue;
use App\Models\CustomMetric;
use App\Models\DailyEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomMetricValue>
 */
class CustomMetricValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'custom_metric_id' => CustomMetric::factory()->create(),
        'daily_entry_id' => DailyEntry::factory()->create(),
        'value' => fake()->numberBetween(1,10),
        ];
    }
}
