<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CustomMetric;
use Illuminate\Database\Seeder;

class CustomMetricSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            CustomMetric::factory(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
