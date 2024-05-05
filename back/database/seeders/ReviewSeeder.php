<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        DB::table('feedback')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $userIds = User::whereHas('role', function($query) {
            $query->where('name', 'Parent');
        })->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'user_id' => $faker->randomElement($userIds),
                'rating' => $faker->numberBetween(1,5),
                'comment' => $faker->sentence,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
