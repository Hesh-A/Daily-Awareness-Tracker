<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Send daily reminder emails to users who have not logged today's entry.
// Runs every day at 10 PM local time.
Schedule::command('reminders:send-daily')->dailyAt('22:00');
