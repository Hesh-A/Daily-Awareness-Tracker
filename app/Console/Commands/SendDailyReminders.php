<?php

namespace App\Console\Commands;

use App\Mail\DailyReminderMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReminders extends Command
{
    protected $signature   = 'reminders:send-daily';
    protected $description = 'Send a reminder email to users who have not logged an entry today';

    public function handle(): int
    {
        $today = now()->toDateString();

        $users = User::whereDoesntHave('dailyEntries', function ($query) use ($today) {
            $query->whereDate('entry_date', $today);
        })->get();

        if ($users->isEmpty()) {
            $this->info('All users have already logged today. No reminders sent.');
            return self::SUCCESS;
        }

        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyReminderMail($user));
        }

        $this->info("Reminders sent to {$users->count()} user(s).");

        return self::SUCCESS;
    }
}
