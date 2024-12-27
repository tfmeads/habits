<?php 

namespace App\Http\Controllers;

use App\Models\Job;
use App\Enums\Period;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class HabitController extends Controller{

    public function index(){

        return view('habits.index',
        [
            'habits' => Habit::all()
        ]);
    }
    
    public function create(){
        $habit = [
            'id'    => 0,
            'name' => '',
            'frequency' => 1,
            'period' => 'Day'
        ];
    
        return view('habits.create', [
            'habit' => $habit
        ]);    
    }
    
    public function show(Habit $habit){
        return view('habits.show',
        [
            'habit' => $habit
        ]
    );
    }
    
    public function store(){
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
    }
    
    public function edit(Habit $habit){
        return view('habits.create',
        [
            'habit' => $habit,
        ]
    );
    }
    
    public function update(Habit $habit){

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
    
        return redirect('/habits');
    }

    public function destroy(Habit $habit){

        //TODO authorize...

        $habit->delete();

        return redirect('/habits');
    }
    
    
}