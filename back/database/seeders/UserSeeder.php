<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('name', 'User')->first();
        $parentRole = Role::where('name','Parent')->first();
        $teacherRole = Role::where('name','Teacher')->first();

        $directoryProfilePhoto = 'public/profilePhotos';
        if (!Storage::exists($directoryProfilePhoto)) {
            Storage::makeDirectory($directoryProfilePhoto);
        }
        $directoryPassports = 'public/passports';
        if (!Storage::exists($directoryPassports)) {
            Storage::makeDirectory($directoryPassports);
        }
        $faker = Faker::create();
        $profilePhoto = 'storage/profilePhotos/'.$faker->image(storage_path('app/' . $directoryProfilePhoto), 500, 312, null, false);
        $passport = 'storage/passports/'.$faker->image(storage_path('app/' . $directoryPassports), 500, 312, null, false);

        User::create([
            'name' => 'Kanykei',
            'surname' => 'Matkalyk',
            'address' => 'Alymkulova-33',
            'phone_number' => '0777221201',
            'email' => 'kanysh150@gmail.com',
            'password' => Hash::make('123'),
            'email_verified_at' => now(),
            'role' => 1,
            'amount_of_child' => 0,
            'profile_photo' => $profilePhoto,
            'passport_back' => $passport,
            'passport_front' => $passport,
            'deleted' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'role' => $userRole->id,
                'amount_of_child' => 0,
                'profile_photo' => $profilePhoto,
                'passport_back' => $passport,
                'passport_front' => $passport,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'role' => $parentRole->id,
                'amount_of_child' => 0,
                'profile_photo' => $profilePhoto,
                'passport_back' => $passport,
                'passport_front' => $passport,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'role' => $teacherRole->id,
                'amount_of_child' => 0,
                'profile_photo' => $profilePhoto,
                'passport_back' => $passport,
                'passport_front' => $passport,
                'deleted' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
