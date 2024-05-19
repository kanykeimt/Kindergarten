<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\DaysOfWeek;
use App\Models\Group;
use App\Models\Schedule;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Schedules')->truncate();

        $classes = Classes::all()->pluck('id');
        $groups = Group::all()->pluck('id');
        $days = DaysOfWeek::all()->pluck('id');
        $faker = Faker::create();

        $startTime = strtotime('08:00');
        $endTime = strtotime('17:00');

        for ($i = 0; $i < 30; $i++) {
            $classes_id = $faker->randomElement($classes);
            $group_id = $faker->randomElement($groups);
            $day_id = $faker->randomElement($days);

            $timeFrom = rand($startTime, $endTime - 3600);
            $timeTo = $timeFrom + 3600;

            $timeFromFormatted = date('H:i', $timeFrom);
            $timeToFormatted = date('H:i', $timeTo);

            Schedule::create([
                'classes_id' => $classes_id,
                'group_id' => $group_id,
                'day' => $day_id,
                'time_from' => $timeFromFormatted,
                'time_to' => $timeToFormatted,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
