<?php

use App\Mail\DailyReminderMail;
use App\Models\DailyEntry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\artisan;

it('sends a reminder to users who have not logged an entry today', function () {
    Mail::fake();

    $userWithout = User::factory()->create();
    $userWith    = User::factory()->create();

    // $userWith already has an entry for today
    DailyEntry::factory()->create([
        'user_id'    => $userWith->id,
        'entry_date' => now()->toDateString(),
    ]);

    artisan('reminders:send-daily')->assertSuccessful();

    Mail::assertSent(DailyReminderMail::class, fn ($mail) => $mail->hasTo($userWithout->email));
    Mail::assertNotSent(DailyReminderMail::class, fn ($mail) => $mail->hasTo($userWith->email));
});

it('sends no emails when all users have logged today', function () {
    Mail::fake();

    $user = User::factory()->create();

    DailyEntry::factory()->create([
        'user_id'    => $user->id,
        'entry_date' => now()->toDateString(),
    ]);

    artisan('reminders:send-daily')->assertSuccessful();

    Mail::assertNothingSent();
});

it('sends reminders to every user who is missing an entry', function () {
    Mail::fake();

    $users = User::factory()->count(3)->create();

    artisan('reminders:send-daily')->assertSuccessful();

    foreach ($users as $user) {
        Mail::assertSent(DailyReminderMail::class, fn ($mail) => $mail->hasTo($user->email));
    }
});
