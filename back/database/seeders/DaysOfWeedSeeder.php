<?php

namespace Database\Seeders;

use App\Models\DaysOfWeek;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysOfWeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('days_of_week')->truncate();
        $daysOfWeekRussia = array(
            "Понедельник", // Monday
            "Вторник",     // Tuesday
            "Среда",       // Wednesday
            "Четверг",     // Thursday
            "Пятница",     // Friday
            "Суббота",     // Saturday
            "Воскресенье"  // Sunday
        );
        $daysOfWeekKyrgyz = array(
            "Дүйшөмбү",     // Monday
            "Шейшемби",      // Tuesday
            "Шаршемби",      // Wednesday
            "Бейшемби",      // Thursday
            "Жума",          // Friday
            "Ишемби",        // Saturday
            "Жекшемби"       // Sunday
        );

        for($i = 0; $i < count($daysOfWeekRussia); $i++) {
            DaysOfWeek::create([
                'name_kg' => $daysOfWeekKyrgyz[$i],
                'name_ru' => $daysOfWeekRussia[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }

}
