<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Child;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    private $faker;

    public function run()
    {
        $this->faker = Faker::create();

        // Retrieve all groups
        $groups = Group::pluck('id')->toArray();

        foreach ($groups as $group) {
            $childrenIds = Child::where('group_id', $group)->pluck('id')->toArray();

            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::now()->format('Y-m-d');

                $childrenData = $this->generateChildrenData($childrenIds);
                $childrenData = json_encode($childrenData);
                Attendance::create([
                    'group_id' => $group,
                    'date' => $date,
                    'children' => $childrenData,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }

    private function generateChildrenData($childrenIds)
    {
        $childrenData = [];

        // Generate random child attendance data
        foreach ($childrenIds as $childId) {
            $childrenData[$childId] = $this->faker->boolean();
        }

        return $childrenData;
    }
}
