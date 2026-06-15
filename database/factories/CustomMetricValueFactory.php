<?php

namespace Database\Factories;

use App\Models\CustomMetricValue;
use App\Models\CustomMetric;
use App\Models\DailyEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomMetricValueFactory extends Factory
{
    protected $model = CustomMetricValue::class;

    public function definition(): array
    {
        return [
            'custom_metric_id' => CustomMetric::factory(),
            'daily_entry_id' => DailyEntry::factory(),
            'value' => fake()->numberBetween(0, 100),
        ];
    }
}
