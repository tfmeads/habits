<?php

use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::get('/', function () {
    return view('home');
});


Route::get('/habits', [HabitController::class, 'index']);
Route::get('/habits/create', [HabitController::class, 'create']);
Route::get('/habits/{habit}', [HabitController::class, 'show']);
Route::get('/habits/{habit}/edit', [HabitController::class, 'edit']);
Route::patch('/habits/{habit}', [HabitController::class, 'update']);
Route::delete('/habits/{habit}', [HabitController::class, 'destroy']);


Route::get('/about', function () {
    return view('about');
});