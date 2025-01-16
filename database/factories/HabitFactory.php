<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Remove trailing period from fake text
        $name = fake()->unique()->text($maxNbChars = 20);
        $name = str_replace('.','',$name);

        $def = 
        [
            'name' =>       $name,
            'user_id' =>    1, //default to test acct for now
            'frequency' =>  fake()->randomDigitNotNull(),
            'period' =>     fake()->randomElement($array = (Period::cases())),
            'daily_max' => 1,
        ];

        //$def['daily_max'] = ($def['period'] == Period::DAY) ? 0 : 1;

        return $def;
    }
}
