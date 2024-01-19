<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_default_value = [
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'), // 123123123
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $admin = User::firstOrCreate(array_merge([
            'email' => 'admin@gmail.com',
            'name' => 'Admin'
        ], $user_default_value));

        $guide = User::firstOrCreate(array_merge([
            'email' => 'guide@gmail.com',
            'name' => 'Guide'
        ], $user_default_value));

        $admin->assignRole('admin');
        $guide->assignRole('guide');

        $users = User::factory(10)->create();
        foreach ($users as $user )
        {
            $user->assignRole('user');
        }
    }
}
