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

class EnrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Enrolls')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::where('role', 'ROLE_USER')->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $birth_certificate = $faker->image(('storage/app/public/enrollImages/birthCertificates'),500,312, null, false);
            $med_certificate =$faker->image(('storage/app/public/enrollImages/medCertificates'),500,312, null, false);
            $photo = $faker->image(('storage/app/public/enrollImages/photos'),500,312, null, false);
            Enroll::create([
                'parent_id' => $faker->randomElement($parentIds),
                'name' => $faker->word,
                'surname' => $faker->word,
                'birth_date' => $faker->dateTimeBetween('-7 years', '-2 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['MALE', 'FEMALE']),
                'birth_certificate' => 'storage/enrollImages/birthCertificates/'. $birth_certificate,
                'med_certificate' => 'storage/enrollImages/medCertificates/'. $med_certificate,
                'med_disability' => null,
                'photo' => 'storage/enrollImages/photos/'. $photo,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
