<?php

namespace Database\Seeders;

use App\Models\Feedback;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feedback')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $parentIds = User::where('role', 'ROLE_PARENT')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Feedback::create([
                'parent_id' => $faker->randomElement($parentIds),
                'starts' => $faker->range(1,5),
                'comment' => $faker->sentence,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
