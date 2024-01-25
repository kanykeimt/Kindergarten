<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        // Create an admin user
        User::create([
            'name' => 'Admin',
            'surname' => 'User',
            'address' => '123 Admin Street',
            'phone_number' => '1234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123123'),
            'email_verified_at' => now(),
            'role' => 'ROLE_ADMIN',
            'amount_child' => 0,
            'remember_token' => Str::random(1),
            'profile_photo' => null,
            'passport_back' => null,
            'passport_front' => null,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Use Faker to generate random data for parent users
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'role' => 'ROLE_PARENT',
                'amount_child' => $faker->numberBetween(1, 5),
                'remember_token' => Str::random(6),
                'profile_photo' => null,
                'passport_back' => null,
                'passport_front' => null,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // Use Faker to generate random data for teacher users
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'ROLE_TEACHER',
                'amount_child' => 0,
                'remember_token' => Str::random(5),
                'profile_photo' => null,
                'passport_back' => null,
                'passport_front' => null,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // Use Faker to generate random data for regular users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'ROLE_USER',
                'amount_child' => 0,
                'remember_token' => Str::random(5),
                'profile_photo' => null,
                'passport_back' => null,
                'passport_front' => null,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    }
}
}
