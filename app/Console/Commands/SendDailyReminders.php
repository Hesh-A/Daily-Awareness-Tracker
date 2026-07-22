<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmail;
use App\Models\DailyEntry;
use App\Models\CustomMetric;
use App\Models\User;


#[Signature('reminders:send-daily')]
#[Description('Send daily reminder emails to users who have not logged an entry today')]
class SendDailyReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->toDateString();

        $users = User::whereDoesntHave('dailyEntries', function($query) use ($today){

          $query->where('entry_date',$today);
        })->take(1)->get();

        if ($users->isEmpty()) {
          $this->info('Everyone has logged today. No reminders sent.');
          return self::SUCCESS;
        }

        foreach($users as $user){

            Mail::to($user->email)->send(new ReminderEmail($user));
        }

    }
}
