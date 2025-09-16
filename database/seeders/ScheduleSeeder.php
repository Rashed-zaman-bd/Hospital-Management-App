<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $startTime = Carbon::createFromTime(16, 0, 0); // 4 PM
        $endTime   = Carbon::createFromTime(22, 0, 0); // 10 PM
        $date = Carbon::today();
        $dayName = $date->format('l');

        foreach (Doctor::all() as $doctor) {
            $time = $startTime->copy();
            while ($time < $endTime) {
                Schedule::updateOrCreate(
                    [
                        'doctor_id' => $doctor->id,
                        'date' => $date->format('Y-m-d'),
                        'slot_time' => $time->format('H:i:s')
                    ],
                    [
                        'day' => $dayName,
                        'status' => 'available',
                    ]
                );
                $time->addMinutes(10);
            }
        }
    }
}

