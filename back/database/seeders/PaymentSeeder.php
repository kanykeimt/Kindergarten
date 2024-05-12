<?php

namespace Database\Seeders;

use App\Models\Child;
use App\Models\Group;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Random\RandomException;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        DB::table('Payments')->truncate();

        $faker = Faker::create();
        $childrenIds = Child::inRandomOrder()->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $date_from = $faker->date('2024-05-01');
            $payment_amount = $faker->numberBetween(270,7000);
            $days = round($payment_amount / 270);

            $date = new DateTime($date_from);
            $daysExcludingSundays = 0;
            while ($daysExcludingSundays < $days) {
                if ($date->format('w') != 0) {
                    $daysExcludingSundays++;
                }
                $date->modify('+1 day');
            }
            $date_to = $date->format('Y-m-d');

            Payment::create([
                'child_id' => $faker->randomElement($childrenIds),
                'payment_amount' => $payment_amount,
                'date_from' => $date_from,
                'date_to' => $date_to,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            $date_from = $faker->date('2024-04-01');
            $payment_amount = $faker->numberBetween(270,7000);
            $days = round($payment_amount / 270);

            $date = new DateTime($date_from);
            $daysExcludingSundays = 0;
            while ($daysExcludingSundays < $days) {
                if ($date->format('w') != 0) {
                    $daysExcludingSundays++;
                }
                $date->modify('+1 day');
            }
            $date_to = $date->format('Y-m-d');

            Payment::create([
                'child_id' => $faker->randomElement($childrenIds),
                'payment_amount' => $payment_amount,
                'date_from' => $date_from,
                'date_to' => $date_to,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
