<?php

use App\Models\User;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;

it('creates a custom metric model', function () {
    $metric = CustomMetric::factory()->create();

    expect($metric)->toBeInstanceOf(CustomMetric::class);
    expect($metric->id)->not->toBeNull();
});

it('assigns fillable attributes correctly', function () {
    $metric = CustomMetric::factory()->create([
        'name' => 'Mood',
        'description' => 'Track the mood',
    ]);

    expect($metric->name)->toBe('Mood');
    expect($metric->description)->toBe('Track the mood');
});

it('belongs to a user', function () {
    $metric = CustomMetric::factory()->create();

    expect($metric->user)->toBeInstanceOf(User::class);
});

it('has many metric values', function () {
    $metric = CustomMetric::factory()->create();

    CustomMetricValue::factory()->count(4)->create([
        'custom_metric_id' => $metric->id,
    ]);

    expect($metric->metricValues)->toHaveCount(4);
});
