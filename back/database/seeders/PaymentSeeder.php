<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Payments')->truncate();

        // Use Faker to generate random data for groups
        $faker = Faker::create();
        $childrenIds = Group::inRandomOrder()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            Payment::create([
                'child_id' => $faker->randomElement($childrenIds),
                'payment_amount' => $faker->numberBetween(1, 6500),
                'date_from' => $faker->date(),
                'date_to' => $faker->date(),
                'expired' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
