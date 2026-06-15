<?php

use App\Models\User;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;
use App\Models\DailyEntry;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

it('allows a user to save a metric value for their daily entry', function () {
    $user   = User::factory()->create();
    $entry  = DailyEntry::factory()->create(['user_id' => $user->id]);
    $metric = CustomMetric::factory()->create(['user_id' => $user->id]);

    actingAs($user);

    post('/custom-metric-values', [
        'daily_entry_id'   => $entry->id,
        'custom_metric_id' => $metric->id,
        'value'            => 42,
    ])->assertRedirect();

    expect(
        CustomMetricValue::where([
            'daily_entry_id'   => $entry->id,
            'custom_metric_id' => $metric->id,
            'value'            => 42,
        ])->exists()
    )->toBeTrue();
});

it('updates an existing metric value rather than creating a duplicate', function () {
    $user   = User::factory()->create();
    $entry  = DailyEntry::factory()->create(['user_id' => $user->id]);
    $metric = CustomMetric::factory()->create(['user_id' => $user->id]);

    CustomMetricValue::factory()->create([
        'daily_entry_id'   => $entry->id,
        'custom_metric_id' => $metric->id,
        'value'            => 10,
    ]);

    actingAs($user);

    post('/custom-metric-values', [
        'daily_entry_id'   => $entry->id,
        'custom_metric_id' => $metric->id,
        'value'            => 99,
    ])->assertRedirect();

    expect(CustomMetricValue::where([
        'daily_entry_id'   => $entry->id,
        'custom_metric_id' => $metric->id,
    ])->count())->toBe(1);

    expect(CustomMetricValue::where([
        'daily_entry_id'   => $entry->id,
        'custom_metric_id' => $metric->id,
    ])->value('value'))->toBe(99);
});
