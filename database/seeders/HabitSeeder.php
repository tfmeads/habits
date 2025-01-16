<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{

    protected function taylorDefaults(): void{
        Habit::factory()->create([
            'name' => 'Brush Teeth',
            'period' => Period::DAY,
            'frequency' => 2,
            'user_id' => 1,
        ]);        
        
        Habit::factory()->create([
            'name' => 'Make Bed',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Vitamins',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Take Medicine',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Meditate',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Midori Flashcards',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Lesser Chore',
            'period' => Period::DAY,
            'frequency' => 1,
            'user_id' => 1,
        ]);


        Habit::factory()->create([
            'name' => 'Greater Chore',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Read Fiction',
            'period' => Period::WEEK,
            'frequency' => 3,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Read Nonfiction',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => '読書',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Creative Reading',
            'period' => Period::WEEK,
            'frequency' => 1,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Vocal Practice',
            'period' => Period::WEEK,
            'frequency' => 4,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Repertoire',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Rhythm Exercises',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'New Material',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'Campfire Song',
            'period' => Period::WEEK,
            'frequency' => 2,
            'user_id' => 1,
        ]);

        Habit::factory()->create([
            'name' => 'Strength Workout',
            'period' => Period::WEEK,
            'frequency' => 5,
            'user_id' => 1,
        ]);
        Habit::factory()->create([
            'name' => 'Cardio Workout',
            'period' => Period::WEEK,
            'frequency' => 3,
            'user_id' => 1,
        ]);

        Habit::factory()->create([
            'name' => 'Jam Sesh',
            'period' => Period::MONTH,
            'frequency' => 7,
            'user_id' => 1,
        ]);

        Habit::factory()->create([
            'name' => 'Presets',
            'period' => Period::MONTH,
            'frequency' => 5,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'New Art',
            'period' => Period::MONTH,
            'frequency' => 3,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'Art Refinement',
            'period' => Period::MONTH,
            'frequency' => 7,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'Composition',
            'period' => Period::MONTH,
            'frequency' => 6,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'Lyrics',
            'period' => Period::MONTH,
            'frequency' => 6,
            'user_id' => 1,
            'daily_max' => 0
        ]);
        Habit::factory()->create([
            'name' => 'VJ Sketch',
            'period' => Period::MONTH,
            'frequency' => 5,
            'user_id' => 1,
            'daily_max' => 0
        ]);
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->taylorDefaults();


        //Todo re-enable later, create a dozen test users with random habits

        //Habit::factory(8)->create();

    }
}
