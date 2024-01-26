<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('children')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::where('role', 'ROLE_PARENT')->pluck('id')->toArray();
        $groupIds = Group::inRandomOrder()->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            Child::create([
                'parent_id' => $faker->randomElement($parentIds),
                'name' => $faker->word,
                'surname' => $faker->word,
                'birth_date' => $faker->dateTimeBetween('-7 years', '-2 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['MALE', 'FEMALE']),
                'birth_certificate' => $faker->image(('storage/app/public/childImages/birthCertificates'),500,312, null, false),
                'med_certificate' => $faker->image(('storage/app/public/childImages/medCertificates'),500,312, null, false),
                'med_disability' => null,
                'photo' => $faker->image(('storage/app/public/childImages/photos'),500,312, null, false),
                'payment' => false,
                'deleted' => 0,
                'group_id' => $faker->randomElement($groupIds),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
