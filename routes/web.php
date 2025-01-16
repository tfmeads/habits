<?php

use Carbon\Carbon;

use App\Enums\Period;
use App\Models\Habit;
use App\Models\HabitEvent;
use App\Mail\DailyHabitsMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\ProfileController;
use Whitecube\LaravelTimezones\Facades\Timezone;

Route::get('/', function () {

    if(Auth::guest()){
        return view('about');
    }
    else{
        return view('home',
        [
            'habits' => Habit::where('user_id',Auth::user()->id)->get(),
        ]);
    }
}
);

Route::get('mailtest', function(){
    if(Auth::guest()){
        return redirect('/login');
    }

    Mail::to(Auth::user()->email)->send(
        new DailyHabitsMail()
    );

    return 'Mail sent to '.Auth::user()->email;
});

Route::resource('habits', HabitController::class)->middleware('auth');

Route::post('habits/{habit}/logevent', function ($habit){


    $event = HabitEvent::factory()->create([
        'habit_id' => $habit,
        'logged_at' => Carbon::now(), //store in db as UTC, Timezone library takes care of user display
        'note' => '',
    ]);

    return redirect(session('previous-url'));;
    

})->middleware(['auth', 'verified']);

Route::view('/about', 'about');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
