<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            ChildSeeder::class,
            EnrollSeeder::class,
            ReviewSeeder::class,
            PaymentSeeder::class,
            DaysOfWeedSeeder::class,
            ClassesSeeder::class,
            ScheduleSeeder::class,




        ]);
    }
}
