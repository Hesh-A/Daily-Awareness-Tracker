<?php

use App\Models\DailyEntry;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;
use App\Models\User;

test('A user can view their daily entries', function () {
    $user = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
    ]);
    
    $response = $this->actingAs($user)->get('/daily-entries');
    $response->assertStatus(200);
    $response->assertViewIs('daily_entries.index');
    $response->assertsee($entry->entry_date);
  
});



test('A user can create a daily entry',function(){

    $user = User::factory()->create();

    $mood = CustomMetric::factory()->create([
        'user_id' => $user->id,
    ]);

    $energy = CustomMetric::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->post('/daily-entries',[

       'entry_date' => '2024-06-01',
       'hours_creative_work' => 5,
       'quality_score' => 2,
       'notes' => 'Good day of work',
       'metrics' => [
        $mood->id => 4,
        $energy->id=> 3,
       ]
    ]);

    $entry = DailyEntry::first();

    expect(CustomMetricValue::where('daily_entry_id', $entry->id)->count())->toBe(2);
    expect(CustomMetricValue::where([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $mood->id,
        'value' => 4,])->exists())->toBeTrue();

    expect(CustomMetricValue::where([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $energy->id,
        'value' => 3,])->exists())->toBeTrue();

    $response->assertRedirect('/daily-entries');
    expect(DailyEntry::where('user_id', $user->id)->count())->toBe(1);
});


test('A user cannot create a daily entry for another user',function(){

    $user = User::factory()->create();
    $other = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $other->id,
    ]);

    $response = $this->actingAs($user)->get("/daily-entries/{$entry->id}/edit")
    ->assertForbidden();


});

test('A user can delete their own daily entry', function(){

    $user = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->delete("/daily-entries/{$entry->id}");
    
    $response->assertRedirect('/daily-entries');
    expect(DailyEntry::where('id', $entry->id)->count())->toBe(0);
});


test('A user cannot delete another user\'s daily entry', function(){

    $user = User::factory()->create();
    $other = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $other->id,
    ]);

    $response = $this->actingAs($user)->delete("/daily-entries/{$entry->id}")
    ->assertForbidden();

    expect(DailyEntry::where('id', $entry->id)->count())->toBe(1);
});

test('A user can update their own daily entry', function(){

    $user = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
        'hours_creative_work' => 5,
        'quality_score' => 2,
        'notes' => 'Good day of work',
        'entry_date' => '2024-05-01',
    ]);

    $response = $this->actingAs($user)->put("/daily-entries/{$entry->id}",[
        'entry_date' => '2024-06-01',
        'hours_creative_work' => 6,
        'quality_score' => 1,
        'notes' => 'Updated notes',
    ]);

    $response->assertRedirect('/daily-entries');

    $entry->refresh();

    expect($entry->entry_date)->toBe('2024-06-01');
    expect($entry->hours_creative_work)->toBe(6);
    expect($entry->quality_score)->toBe(1);
    expect($entry->notes)->toBe('Updated notes');
    
});

test('A user can update metric values on a daily entry', function () {
    $user = User::factory()->create();

    $mood = CustomMetric::factory()->create(['user_id' => $user->id]);
    $energy = CustomMetric::factory()->create(['user_id' => $user->id]);

    $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
        'entry_date' => '2024-01-01',
        'hours_creative_work' => 3,
        'quality_score' => 1,
        'notes' => 'Old notes',
    ]);
 
    CustomMetricValue::create([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $mood->id,
        'value' => 7,
    ]);

    CustomMetricValue::create([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $energy->id,
        'value' => 5,
    ]);
  
    $response = $this->actingAs($user)->put("/daily-entries/{$entry->id}", [
        'entry_date' => '2024-01-02',
        'hours_creative_work' => 6,
        'quality_score' => 2,
        'notes' => 'Updated notes',
        'metrics' => [
            $mood->id => 4,
            $energy->id => 8,
        ],
    ]);

    $response->assertRedirect('/daily-entries');

    expect(CustomMetricValue::where([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $mood->id,
        'value' => 4,
    ])->exists())->toBeTrue();

    expect(CustomMetricValue::where([
        'daily_entry_id' => $entry->id,
        'custom_metric_id' => $energy->id,
        'value' => 8,
    ])->exists())->toBeTrue();
});


test('A user cannot update another user\'s daily entry', function(){

    $user = User::factory()->create();
    $other = User::factory()->create();

    $entry = DailyEntry::factory()->create([
        'user_id' => $other->id,
        'hours_creative_work' => 5,
        'quality_score' => 2,
        'notes' => 'Good day of work',
        'entry_date' => '2024-05-01',
    ]);

    $response = $this->actingAs($user)->put("/daily-entries/{$entry->id}",[
        'entry_date' => '2024-06-01',
        'hours_creative_work' => 6,
        'quality_score' => 1,
        'notes' => 'Updated notes',
    ])->assertForbidden();

    $entry->refresh();

    expect($entry->entry_date)->toBe('2024-05-01');
    expect($entry->hours_creative_work)->toBe(5);
    expect($entry->quality_score)->toBe(2);
    expect($entry->notes)->toBe('Good day of work');
    
});



