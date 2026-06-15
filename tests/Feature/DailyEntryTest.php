<?php

use App\Models\User;
use App\Models\DailyEntry;
use App\Models\CustomMetric;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;
use function Pest\Laravel\delete;

it('allows a user to create a daily entry', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post('/daily-entries', [
        'entry_date' => '2024-01-01',
        'hours_creative_work' => 5,
        'quality_score' => 1,
        'notes' => 'Test entry',
    ]);

    $response->assertRedirect('/daily-entries');
    expect($user->dailyEntries()->count())->toBe(1);
});

it('saves metric values when creating a daily entry', function () {
    $user = User::factory()->create();
    actingAs($user);

    $metric1 = CustomMetric::factory()->create(['user_id' => $user->id]);
    $metric2 = CustomMetric::factory()->create(['user_id' => $user->id]);

    post('/daily-entries', [
        'entry_date' => '2024-01-01',
        'hours_creative_work' => 5,
        'quality_score' => 1,
        'notes' => 'Test entry',
        'metrics' => [
            $metric1->id => 7,
            $metric2->id => 4,
        ],
    ]);

    $entry = $user->dailyEntries()->first();

    expect($entry->metricValues()->count())->toBe(2);
});

it('allows a user to update a daily entry', function () {
    $user = User::factory()->create();
    actingAs($user);

    $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
        'hours_creative_work' => 3,
    ]);

    $response = put("/daily-entries/{$entry->id}", [
        'entry_date' => '2024-01-02',
        'hours_creative_work' => 6,
        'quality_score' => 2,
        'notes' => 'Updated',
    ]);

    $response->assertRedirect('/daily-entries');

    $entry->refresh();
    expect($entry->hours_creative_work)->toBe(6);
});

it('allows a user to delete a daily entry', function () {
    $user = User::factory()->create();
    actingAs($user);

    $entry = DailyEntry::factory()->create(['user_id' => $user->id]);

    $response = delete("/daily-entries/{$entry->id}");

    $response->assertRedirect('/daily-entries');
    expect(DailyEntry::count())->toBe(0);
});
