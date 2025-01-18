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
            'daily_max' => 1,
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

        //What's the frequency, Kenneth?
        $kenneth = request('frequency');

        request()->validate([
            'name' => ['required', 'min:2','max:50',Rule::unique('habits')->whereNull('deleted_at')],
            'frequency' => ['required','numeric','min:1','max:99'],
            'period' => ['required'],
            'daily_max' => ['bail','required','numeric','min:0',"max:$kenneth"],
        ]);

        
        $habit = Habit::create([
            'name' => request('name'),
            'frequency' => $kenneth,
            'period' => request('period'),
            'user_id' => Auth::user()->id,
            'daily_max' => request('daily_max')
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

        //What's the frequency, Kenneth?
        $kenneth = request('frequency');

        $customMessages = [
            'daily_max.max' => 'The :attribute field must not be greater than the frequency.'
        ];

        request()->validate([
            'name' => ['required', 'min:2','max:50',Rule::unique('habits')->ignore($habit->id)->whereNull('deleted_at')],
            'frequency' => ['required','numeric','min:1','max:99'],
            'period' => ['required', Rule::in(array_column(Period::cases(), 'value'))],
            'daily_max' => ['bail','required','numeric','min:0',"max:$kenneth"],
        ], $customMessages);

    
    
        $habit->update([
            'name' => request('name'),
            'frequency' => request('frequency'),
            'period' => request('period'),
            'daily_max' => request('daily_max')
        ]);
    
        return redirect(session('previous-url'));;
    }

    public function destroy(Habit $habit){

        Gate::authorize('edit-habit',$habit);

        $habit->delete();

        return redirect(session('previous-url'));;
    }
    
    
}