<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exercises = [
            ['name' => 'Walking (Halki Chal)', 'met_value' => 3.5],
            ['name' => 'Walking (Tez Chal)', 'met_value' => 4.5],
            ['name' => 'Running (Dour)', 'met_value' => 9.8],
            ['name' => 'Cycling (Cycle Chalana)', 'met_value' => 7.5],
            ['name' => 'Gym (Weight Training)', 'met_value' => 6.0],
            ['name' => 'Yoga', 'met_value' => 2.5],
            ['name' => 'Swimming (Tairna)', 'met_value' => 6.0],
            ['name' => 'Skipping (Rassi Koodna)', 'met_value' => 12.3],
        ];

        foreach ($exercises as $ex) {
            Exercise::create($ex);
        }
    }
}