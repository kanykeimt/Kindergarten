<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Gallery;
use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('galleries')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $groupIds = Group::inRandomOrder()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $image = $faker->image(('storage/app/public/group_gallery'),500,312, null, false);
            Gallery::create([
                'group_id' => $faker->randomElement($groupIds),
                'image' => 'storage/group_gallery/'. $image,
                'video' => null,
                'info' => $faker->sentence,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
