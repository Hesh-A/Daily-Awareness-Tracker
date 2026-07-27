<?php
use App\Models\User;
use App\Models\DailyEntry;
it('lets the user see their daily entries', function () {

   //given i am signed in as a user
   $user = User::factory()->create();
   $this->actingAs($user);


  DailyEntry::factory()->create([
      'user_id'    => $user->id,
      'entry_date' => now()->subDays(1)->toDateString(),
  ]);

  //when i visit the daily entries page  I can see my daily entry

   visit('/daily-entries')
   ->assertSee('Daily Entries');


});
