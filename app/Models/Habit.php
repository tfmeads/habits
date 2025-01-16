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

    protected $fillable = ['period','frequency','name','user_id'];
    protected $casts = ['period' => Period::class];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function events() : HasMany
    {
        return $this->hasMany(HabitEvent::class);
    }

    public function get_deadline(){
        $now = Timezone::date(Carbon::now());

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
}