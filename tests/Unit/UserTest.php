<?php
use App\Models\User;
use App\Models\DailyEntry;
use App\Models\CustomMetric;
use Illuminate\Support\Facades\Hash;


it ('creates a user model', function () {

//when I create a user model
    $user = User::factory()->create();

// A user model should be created
    expect($user)->toBeInstanceOf(User::class);
    expect($user->id)->not->toBeNull();

});

it ('assigns fillable attributes correctly', function(){
  // when given the attributes
  $user = User::factory()->create([
    'name'=> 'Arshana',
    'email' => 'test@mail.com',

  ]);
  // they get assigned correctly
  expect($user->name)->toBe('Arshana');
  expect($user->email)->toBe('test@mail.com');

});

it('hashes the password when fillable', function () {
    // when i create a password
    $user = User::factory()->create([
        'password' => 'secret123',
    ]);

    // it Should NOT be plain text
    expect($user->password)->not->toBe('secret123');

    // it Should be hashed correctly
    expect(Hash::check('secret123', $user->password))->toBeTrue();
});


//test the daily-entry relationship with the user model
it ('has many daily entries' , function(){

// when I create multiple daily entries for the user
    $user = User::factory()->create();

    DailyEntry::factory()->count(3)->create(['user_id' => $user->id]);

//the user should have 3 daily entries assigned

   expect($user->dailyEntries)->toHaveCount(3);

});


it ('has many custom Metrics' , function(){

// when I create multiple daily entries for the user
    $user = User::factory()->create();

    CustomMetric::factory()->count(3)->create([
     'user_id' => $user->id,
      
    ]);

//the user should have 3 daily entries assigned

   expect($user->customMetrics)->toHaveCount(3);

});



