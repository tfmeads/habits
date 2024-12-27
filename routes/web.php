<?php

use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/habits', function () {

    return view('habits.index',
    [
        'habits' => Habit::all()
    ]
);
});


Route::get('/habits/create', function () {
    $habit = [
        'name' => '',
        'frequency' => 1,
        'period' => 'Day'
    ];

    return view('habits.create', [
        'habit' => $habit
    ]);

});

Route::post('/habits', function () {

    request()->validate([
        'name' => ['required', 'min:2','max:50',Rule::unique('habits')->whereNull('deleted_at')],
        'frequency' => ['required','min:1','max:99'],
        'period' => ['required'],
    ]);
    
    $habit = Habit::create([
        'name' => request('name'),
        'frequency' => request('frequency'),
        'period' => request('period')
    ]);

    return redirect('/habits');
});

Route::get('/habits/{id}', function ($id) {

    return view('habits.show',
    [
        'habit' => Habit::findOrFail($id)
    ]
);
});
Route::get('/habits/{id}/edit', function ($id) {

    return view('habits.create',
    [
        'habit' => Habit::findOrFail($id),
        'selected_id' => $id
    ]
);
});

Route::patch('/habits/{id}', function ($id) {

    request()->validate([
        'name' => ['required', 'min:2','max:50',Rule::unique('habits')->ignore($id)->whereNull('deleted_at')],
        'frequency' => ['required','min:1','max:99'],
        'period' => ['required', Rule::in(array_column(Period::cases(), 'value'))],
    ]);

    $habit = Habit::findOrFail($id);

    $habit->update([
        'name' => request('name'),
        'frequency' => request('frequency'),
        'period' => request('period')
    ]);

    return redirect('/habits');
});

Route::delete('/habits/{id}', function ($id) {

    //TODO authorize...

    $habit = Habit::findOrFail($id);
    $habit->delete();

    return redirect('/habits');
});


Route::get('/about', function () {
    return view('about');
});