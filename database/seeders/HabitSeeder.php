<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Habit::factory()->create([
            'name' => 'Brush Teeth',
            'period' => Period::DAY,
            'frequency' => 2
        ]);        
        
        Habit::factory()->create([
            'name' => 'Make Bed',
            'period' => Period::DAY,
            'frequency' => 1
        ]);

        Habit::factory(8)->create();

    }
}
