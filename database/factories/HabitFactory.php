<?php

namespace Database\Factories;

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

        return [
            'name' =>       $name,
            'frequency' =>  fake()->randomDigitNotNull(),
            'period' =>     fake()->randomElement($array = array (\App\Enums\Period::cases()))
        ];
    }
}
