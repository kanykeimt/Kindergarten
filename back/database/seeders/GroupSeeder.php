<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $teacherIds = User::where('role', 'ROLE_TEACHER')->pluck('id')->toArray();

        $image = $faker->image(('storage/app/public/groupImages'),500,312, null, false);
        Group::create([
            'name' => "All groups",
            'limit' => $faker->numberBetween(5, 30),
            'description' => $faker->paragraph,
            'image' => 'storage/groupImages/'. $image,
            'teacher_id' => 1,
        ]);

        foreach ($teacherIds as $teacherId) {
            $image = $faker->image(('storage/app/public/groupImages'),500,312, null, false);
            Group::create([
                'name' => $faker->word,
                'limit' => $faker->numberBetween(5, 30),
                'description' => $faker->paragraph,
                'image' => 'storage/groupImages/'. $image,
                'teacher_id' => $teacherId,
            ]);
        }
    }
}
