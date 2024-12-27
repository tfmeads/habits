<?php

use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::get('/', function () {
    return view('home',
    [
        'habits' => Habit::all()
    ]);
}
);

Route::resource('habits', HabitController::class);


Route::view('/about', 'about');