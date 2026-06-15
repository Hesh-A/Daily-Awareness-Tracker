<?php

use App\Models\User;
use App\Models\CustomMetric;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;

it('allows a user to create a custom metric', function () {
    $user = User::factory()->create();
    actingAs($user);

    $response = post('/custom-metrics', ['name' => 'Mood']);

    $response->assertRedirect('/custom-metrics');
    expect(CustomMetric::where('user_id', $user->id)->where('name', 'Mood')->exists())->toBeTrue();
});

it('allows a user to delete their own custom metric', function () {
    $user   = User::factory()->create();
    $metric = CustomMetric::factory()->create(['user_id' => $user->id]);

    actingAs($user);

    delete("/custom-metrics/{$metric->id}")->assertRedirect('/custom-metrics');
    expect(CustomMetric::find($metric->id))->toBeNull();
});
