<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\DailyEntry_Reminder;
use App\Models\User;
use App\Models\DailyEntry;
use App\Models\CustomMetric;

class SendDailyReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $users = User::whereDoesntHave('dailyEntries', function ($query){

         $query->whereDate('entry_date', now()->toDateString());
       } )->get();

       foreach ($users as $user) {
           $user->notify(new DailyEntry_Reminder($user));
       }
    }
}
