<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
//            GallerySeeder::class,
            PaymentSeeder::class,
//            AttendanceSeeder::class,


        ]);
    }
}
