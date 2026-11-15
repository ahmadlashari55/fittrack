<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'age' => 22,
            'gender' => 'male',
            'height_cm' => 175,
            'current_weight_kg' => 70,
            'target_weight_kg' => 65,
            'daily_calorie_goal' => 2000,
        ]);
    }
}