<?php

namespace Database\Seeders;
use App\Models\Enroll;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;

class EnrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $directory = 'public/enrollImages';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::whereHas('role', function($query) {
            $query->where('name', 'User');
        })->pluck('id');

        for ($i = 0; $i < 5; $i++) {
            $image = 'storage/enrollImages/'.$faker->image(storage_path('app/' . $directory), 500, 312, null, false);
            Enroll::create([
                'parent_id' => $faker->randomElement($parentIds),
                'name' => $faker->word,
                'surname' => $faker->word,
                'birth_date' => $faker->dateTimeBetween('-7 years', '-2 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'birth_certificate' => $image,
                'med_certificate' => $image,
                'med_disability' => null,
                'photo' => $image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
