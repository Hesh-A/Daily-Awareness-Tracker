<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DailyEntry;
use App\Models\CustomMetricValue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DailyEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $metrics = $user->customMetrics;
            $startDate = Carbon::now()->subDays(30);

            // Create 30 days of entries
            for ($i = 0; $i < 30; $i++) {
                $entry = DailyEntry::create([
                    'user_id' => $user->id,
                    'entry_date' => $startDate->copy()->addDays($i),
                    'hours_creative_work' => rand(0, 24),
                    'quality_score' => rand(-2, 2),
                    'notes' => $this->generateRandomNotes(),
                ]);

                // Add random metric values for this entry
                if ($metrics->count() > 0) {
                    foreach ($metrics->random(min(2, $metrics->count())) as $metric) {
                        CustomMetricValue::create([
                            'custom_metric_id' => $metric->id,
                            'daily_entry_id' => $entry->id,
                            'value' => rand(0, 100),
                        ]);
                    }
                }
            }
        }
    }

    private function generateRandomNotes(): string
    {
        $notes = [
            'Productive session with good focus.',
            'Worked on important project tasks.',
            'Had some distractions but managed well.',
            'Excellent creative flow today!',
            'Finished key milestone for the week.',
            'Collaborative work with team.',
            'Made progress on design improvements.',
            'Experimented with new ideas.',
            'Organized and planned next steps.',
            'Good balance between tasks and breaks.',
        ];

        return $notes[array_rand($notes)];
    }
}
