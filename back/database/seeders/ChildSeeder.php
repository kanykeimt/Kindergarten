<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $directory = 'public/childrenImages';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::whereHas('role', function($query) {
            $query->where('name', 'Parent');
        })->pluck('id');
        $groupIds = Group::inRandomOrder()->pluck('id')->toArray();


        for ($i = 0; $i < 20; $i++) {
            $image = 'storage/childrenImages'.$faker->image(storage_path('app/' . $directory), 500, 312, null, false);
            Child::create([
                'parent_id' => $faker->randomElement($parentIds),
                'name' => $faker->word,
                'surname' => $faker->word,
                'birth_date' => $faker->dateTimeBetween('-7 years', '-2 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['MALE', 'FEMALE']),
                'birth_certificate' => $image,
                'med_certificate' => $image,
                'med_disability' => null,
                'photo' => $image,
                'deleted' => 0,
                'group_id' => $faker->randomElement($groupIds),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
