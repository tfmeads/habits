<?php 

namespace App\Http\Controllers;

use App\Models\Job;
use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HabitController extends Controller{

    public function index(){
        if(Auth::guest()){
            return redirect('/login');
        }
        
        return view('habits.index',
        [
            'actives' => Habit::where('user_id',Auth::user()->id)->get(),
            'archives' => Habit::where('user_id',Auth::user()->id)->onlyTrashed()->get()
        ]);
    }
    
    public function create(){
        if(Auth::guest()){
            return redirect('/login');
        }

        $habit = [
            'id'    => 0,
            'name' => '',
            'frequency' => 1,
            'period' => Period::DAY
        ];
    
        return view('habits.create', [
            'habit' => $habit
        ]);    
    }
    
    public function show(Habit $habit){

        Gate::authorize('edit-habit',$habit);

        return view('habits.show',
        [
            'habit' => $habit
        ]
    );
    }
    
    public function store(){
        if(Auth::guest()){
            return redirect('/login');
        }

        request()->validate([
            'name' => ['required', 'min:2','max:50',Rule::unique('habits')->whereNull('deleted_at')],
            'frequency' => ['required','min:1','max:99'],
            'period' => ['required'],
        ]);
        
        $habit = Habit::create([
            'name' => request('name'),
            'frequency' => request('frequency'),
            'period' => request('period'),
            'user_id' => Auth::user()->id,
        ]);
    
        return redirect('/habits');
    }
    
    public function edit(Habit $habit){

        Gate::authorize('edit-habit',$habit);
        
        return view('habits.create',
        [
            'habit' => $habit,
        ]
    );
    }
    
    public function update(Habit $habit){

        Gate::authorize('edit-habit',$habit);

        request()->validate([
            'name' => ['required', 'min:2','max:50',Rule::unique('habits')->ignore($habit->id)->whereNull('deleted_at')],
            'frequency' => ['required','min:1','max:99'],
            'period' => ['required', Rule::in(array_column(Period::cases(), 'value'))],
        ]);
    
    
        $habit->update([
            'name' => request('name'),
            'frequency' => request('frequency'),
            'period' => request('period')
        ]);
    
        return redirect(session('previous-url'));;
    }

    public function destroy(Habit $habit){

        Gate::authorize('edit-habit',$habit);

        $habit->delete();

        return redirect(session('previous-url'));;
    }
    
    
}