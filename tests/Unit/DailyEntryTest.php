<?php
use App\Models\User;
use App\Models\DailyEntry;
use App\Models\CustomMetric;
use App\Models\CustomMetricValue;


it('creates a daily-entry model', function () {
    //when I create a user model
    $entry = DailyEntry::factory()->create();

    //A daily entry model should be created 
    expect($entry)->toBeInstanceOf(DailyEntry::class);
    expect($entry->id)->not->toBeNull();


});

it('assigns fillable attributes correctly', function () {

 // when given the attributes
  $user = User::factory()->create();
  $entry = DailyEntry::factory()->create([
        'user_id' => $user->id,
        'hours_creative_work' => 2,
        'quality_score' => 1 ,
        'notes' => "Hello World!",
        'entry_date' => '08/08/2013' ,

  ]);
  // they get assigned to the daily-entry correctly
  expect($entry->id)->toBe($user->id);
  expect($entry-> hours_creative_work )->toBe(2);
  expect($entry-> quality_score )->toBe(1);
  expect($entry-> notes )->toBe("Hello World!");
  expect($entry-> entry_date )->toBe('08/08/2013');


});

it ('belongs to a user' , function(){

// when I create a daily entry

   $entry =  DailyEntry::factory()->create();

//it should have a specific user

   expect($entry->user)->toBeInstanceOf(User::class);

});

it ('has many custom Metric Values' , function(){

// when I create a daily entry

   $entry =  DailyEntry::factory()->create();
// with multiple metric values
   CustomMetricValue::factory()->count(4)->create([
      'daily_entry_id' => $entry->id,
   ]);

//it should have 4 custom Metric values

   expect($entry->metricValues)->toHaveCount(4);

});