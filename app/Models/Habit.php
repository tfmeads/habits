<?php

namespace App\Models;

use Carbon\Carbon;

use App\Models\User;
use App\Enums\Period;
use App\Models\HabitEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Whitecube\LaravelTimezones\Facades\Timezone;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['period','frequency','daily_max','name','user_id'];
    protected $casts = ['period' => Period::class];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function events() : HasMany
    {
        return $this->hasMany(HabitEvent::class);
    }


    public function get_allowed_logs_left($date = NULL){
        if($this->daily_max == 0){
            return 999;
        }

        $valid_events = $this->get_events_for_day($date);

        $left_today = $this->daily_max - $valid_events->count();

        return $left_today;
    }


    public function get_events_for_day($date = NULL){
        $now = $date ? Carbon::parse($date,Timezone::current()) : (Carbon::now());

        //echo "Getting events for day {$this->period->name}, $date\n";

        $start = $now->clone()->startOfDay();
        $end = $now->clone()->endOfDay();
        
        //echo "$start -> $end\n";

        if($this->events->count() > 0){
            return $this->events->toQuery()
            ->where('logged_at', '>=', $start)
            ->where('logged_at', '<', $end)
            ->get();


        }
        return $this->events;
    }

    public function get_events_for_deadline($date = NULL){
        //echo "Getting events for deadline {$this->period->name}, $date\n";
        $start = $this->get_start_date($date);
        $end = $this->get_end_date($date);

        //echo "$start -> $end\n";

        if($this->events->count() > 0){

            return $this->events->toQuery()
            ->where('logged_at', '>=', $start)
            ->where('logged_at', '<', $end)
            ->get();

        }
        return $this->events;
    }

    public function get_start_date($date = NULL){
        $now = $date ? Carbon::parse($date,Timezone::current()) : (Carbon::now());

        $created_at_deadline = '';

        switch($this->period){
            case Period::DAY:
                $created_at_deadline = $now->startOfDay();
                break;
            case Period::WEEK:
                $created_at_deadline = $now->startOfWeek(\Carbon\Carbon::MONDAY);
                break;
            case Period::MONTH:
                $created_at_deadline = $now->startOfMonth();
                break;
            case Period::YEAR:
                $created_at_deadline = $now->startOfYear();
                break;
        }

        return $created_at_deadline;
    }

    public function get_end_date($date = NULL){
        $now = $date ? Carbon::parse($date,Timezone::current()) : (Carbon::now());

        $created_at_deadline = '';

        switch($this->period){
            case Period::DAY:
                $created_at_deadline = $now->endOfDay();
                break;
            case Period::WEEK:
                $created_at_deadline = $now->endOfWeek(\Carbon\Carbon::SUNDAY);
                break;
            case Period::MONTH:
                $created_at_deadline = $now->endOfMonth();
                break;
            case Period::YEAR:
                $created_at_deadline = $now->endOfYear();
                break;
        }

        return $created_at_deadline;
    }
}