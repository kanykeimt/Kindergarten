<?php

namespace Database\Seeders;

use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Classes')->truncate();

        $lessons_name_ru = [
            "Рисование",
            "Музыка",
            "Физкультура",
            "Чтение",
            "Математика",
            "Игра на свежем воздухе",
            "Творческое занятие",
            "Наука",
            "Пение",
            "Конструирование",
            "Танцы",
            "Лепка",
            "Изучение природы",
            "Интерактивные игры",
            "Уроки безопасности"
        ];

        $lessons_name_kg = [
            "Сүрөт тартуу",
            "Музыка",
            "Дене тарбия",
            "Окуу",
            "Математика",
            "Ачык асманда оюндар",
            "Креативдик иш-чара",
            "Илим",
            "Ырдоо",
            "Курулуш",
            "Бий",
            "Моделдөө",
            "Табиятты изилдөө",
            "Интерактивдик оюндар",
            "Коопсуздук сабактары"
        ];

        for ($i = 0; $i < count($lessons_name_ru); $i++) {
            Classes::create([
                'name_kg' => $lessons_name_kg[$i],
                'name_ru' => $lessons_name_ru[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
