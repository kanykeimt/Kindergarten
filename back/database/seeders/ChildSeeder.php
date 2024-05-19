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
        DB::table('children')->truncate();
        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::whereHas('role', function($query) {
            $query->where('name', 'Parent');
        })->pluck('id');
        $groupIds = Group::inRandomOrder()->pluck('id')->toArray();

        foreach ($groupIds as $groupId){
            $directory = 'public/childrenImages/'.$groupId;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
        }

        if (!Storage::exists('public/childrenImages/photos')) {
            Storage::makeDirectory('public/childrenImages/photos');
        }
        if (!Storage::exists('public/childrenImages/birthCertificates')) {
            Storage::makeDirectory('public/childrenImages/birthCertificates');
        }
        if (!Storage::exists('public/childrenImages/medCertificates')) {
            Storage::makeDirectory('public/childrenImages/medCertificates');
        }
        if (!Storage::exists('public/childrenImages/medDisabilities')) {
            Storage::makeDirectory('public/childrenImages/medDisabilities');
        }

        $photo = 'storage/childrenImages/photos/'.$faker->image(storage_path('app/public/childrenImages/photos' ), 500, 312, null, false);
        $birthCertificate = 'storage/childrenImages/birthCertificates/'.$faker->image(storage_path('app/public/childrenImages/birthCertificates' ), 500, 312, null, false);
        $medCertificate = 'storage/childrenImages/medCertificates/'.$faker->image(storage_path('app/public/childrenImages/medCertificates' ), 500, 312, null, false);
        $medDisability = 'storage/childrenImages/medDisabilities/'.$faker->image(storage_path('app/public/childrenImages/medDisabilities' ), 500, 312, null, false);

        for ($i = 0; $i < 20; $i++) {
            $group_id = $faker->randomElement($groupIds);
            $parentId = $faker->randomElement($parentIds);
            Child::create([
                'parent_id' => $parentId,
                'name' => $faker->word,
                'surname' => $faker->word,
                'birth_date' => $faker->dateTimeBetween('-7 years', '-2 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'photo' => $photo,
                'birth_certificate' => $birthCertificate,
                'med_certificate' => $medCertificate,
                'med_disability' => $medDisability,
                'group_id' => $group_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            DB::beginTransaction();
            $parent = User::where('id', $parentId)->get();
            $parent = $parent[0];

            if ($parent->role === 4)
                $parent->update([
                    'role' => 3
                ]);
            $parent->update([
                'amount_of_child' => $parent->amount_of_child + 1
            ]);
            DB::commit();
        }
    }
}
