<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directory = 'public/groupImages';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $teacherIds = User::whereHas('role', function($query) {
            $query->where('name', 'Teacher');
        })->pluck('id');

        foreach ($teacherIds as $teacherId) {
            // Generate a fake image
            $image = 'storage/groupImages/' .$faker->image(storage_path('app/' . $directory), 500, 312, null, false);

            // Create a Group with the generated image path
            Group::create([
                'name' => $faker->word,
                'teacher_id' => $teacherId,
                'limit' => $faker->numberBetween(2, 20),
                'description' => $faker->paragraph,
                'image' =>   $image,
            ]);
        }
    }
}
