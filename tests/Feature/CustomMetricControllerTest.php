<?php
use App\Models\CustomMetric;
use App\Models\User;

test('a user can create their own custom metric', function () {
   
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/custom-metrics', [
        'name' => 'Mood',
        'description' => 'Track your mood daily',
    ]);

    $response->assertRedirect('/custom-metrics');
      
    expect(
    CustomMetric::where('user_id', $user->id)
        ->where('name', 'Mood')
        ->exists()
    )->toBeTrue();


});

test('a user can view their metrics', function(){

    $user = User::factory()->create();

    $metric1 = CustomMetric::factory()->create([
        'user_id' => $user->id,
        'name' => 'Mood',
    ]);

    $metric2 = CustomMetric::factory()->create([
        'user_id' => $user->id,
        'name' => 'Energy',
    ]);

    $response = $this->actingAs($user)->get('/custom-metrics');
    $response->assertstatus(200);
    $response->assertsee('Mood');
    $response->assertsee('Energy');
    

});

test('a user can update their custom metric', function(){

   $user = User::factory()->create();

   $metric = CustomMetric::factory()->create([
    'user_id' => $user->id,
    'name' => 'Mood',
    'description' => 'Track your mood daily',
   ]);

   $response = $this->actingAs($user)->put("/custom-metrics/{$metric->id}", [
    'name' => 'Mood Updated',
    'description' => 'Updated description',
   ]);

   $response->assertRedirect('/custom-metrics');

   $metric->refresh();
   expect($metric->name)->toBe('Mood Updated');
   expect($metric->description)->toBe('Updated description');

});

test('a user cannot update another user’s custom metric', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $metric = CustomMetric::factory()->create([
        'user_id' => $otherUser->id,
        'name' => 'Mood',
    ]);

    $response = $this->actingAs($user)->put("/custom-metrics/{$metric->id}", [
        'name' => 'Hacked',
    ]);

    $response->assertStatus(403);
});

test('a user cannot delete another users custom metric', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $metric = CustomMetric::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    $response = $this->actingAs($user)->delete("/custom-metrics/{$metric->id}");

    $response->assertStatus(403);
});

test('a user can delete their own custom metric', function() {

    $user = User::factory()->create();

    $metric = CustomMetric::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->delete("/custom-metrics/{$metric->id}");

    $response->assertRedirect('/custom-metrics');
    expect(CustomMetric::find($metric->id))->toBeNull();
});
