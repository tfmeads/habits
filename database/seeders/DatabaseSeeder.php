<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Habit;
use Illuminate\Database\Seeder;
use Database\Seeders\HabitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Taylor',
            'email' => 'taylormeads1@gmail.com',
            'password' => '$2y$12$Dm1qbr/DOlKMLHDi6.Kid.xIaEIdvxxK.cpObS0DSkm8pwq5sRYKO'
        ]);

        $this->call(HabitSeeder::class);

    }
}
