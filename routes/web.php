<?php

use Carbon\Carbon;

use App\Enums\Period;
use App\Models\Habit;
use App\Models\HabitEvent;
use App\Mail\DailyHabitsMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\ProfileController;
use Whitecube\LaravelTimezones\Facades\Timezone;

//Homepage
Route::get('/', function () {

    if(Auth::guest()){
        return view('about');
    }
    else{
        return view('home',
        [
            'habits' => Habit::where('user_id',Auth::user()->id)->get(),
            'target_date' => Timezone::date(Carbon::now()),
        ]);
    }
}
);

//Homepage with arguments
Route::get('home/{date?}', function ($date = NULL) {

    $date = str_replace('-','/',$date);

    //404 if date is invalid
    try{
        $timezone_adjusted_date = Timezone::date($date);
    }
    catch(Exception $e){
        abort(404);
    }

    if(Auth::guest()){
        return view('about');
    }
    else{
        return view('home',
        [
            'habits' => Habit::where('user_id',Auth::user()->id)->get(),
            'target_date' => $timezone_adjusted_date,
        ]);
    }
}
);

Route::get('mailtest', function(){
    if(Auth::guest()){
        return redirect('/login');
    }

    $email = Auth::user()->email;

    Mail::to($email)->send(
        new DailyHabitsMail()
    );

    return 'Mail sent to '.$email;
});

Route::resource('habits', HabitController::class)->middleware('auth');

Route::post('habits/{habit}/logevent', function (Habit $habit){

    request()->validate([
        'date' => ['required','date'],
    ]);

    $date = request('date'); 

    $left_today = $habit->get_allowed_logs_left($date);
    
    //Don't allow new events when daily max has been hit
    if($left_today <= 0){
        return redirect(session('previous-url'));
    }

    $event = HabitEvent::factory()->create([
        'habit_id' => $habit,
        'logged_at' => Carbon::parse($date,Timezone::current()), //store in db as UTC, Timezone library takes care of user display
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
