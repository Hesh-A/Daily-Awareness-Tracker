<?php

namespace Database\Seeders;

use App\Models\DailyEntry;
use App\Models\User;
use Illuminate\Database\Seeder;

class DailyEntrySeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            DailyEntry::factory()->count(2)->create(['user_id' => $user->id]);
        });
    }
}
