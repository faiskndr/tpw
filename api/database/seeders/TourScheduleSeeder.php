<?php

namespace Database\Seeders;

use App\Models\TourSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'tour_package_id' => 1,
                'start_date' => '2026-07-10',
                'end_date' => '2026-07-12',
                'quota' => 15,
            ],
            [
                'tour_package_id' => 1,
                'start_date' => '2026-07-20',
                'end_date' => '2026-07-22',
                'quota' => 15,
            ],
            [
                'tour_package_id' => 2,
                'start_date' => '2026-07-15',
                'end_date' => '2026-07-18',
                'quota' => 8,
            ],
            [
                'tour_package_id' => 3,
                'start_date' => '2026-07-05',
                'end_date' => '2026-07-08',
                'quota' => 12,
            ],
            [
                'tour_package_id' => 4,
                'start_date' => '2026-07-12',
                'end_date' => '2026-07-13',
                'quota' => 20,
            ],
            [
                'tour_package_id' => 5,
                'start_date' => '2026-07-18',
                'end_date' => '2026-07-20',
                'quota' => 10,
            ],
        ];

        foreach ($schedules as $schedule) {
            TourSchedule::create($schedule);
        }
    }
}
