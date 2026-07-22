<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DailyEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DailyEntry::factory()->count(5)->create();


    }
}
