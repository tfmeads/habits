<?php

namespace App\Models;

use App\Enums\Period;

use App\Models\Habit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Whitecube\LaravelTimezones\Casts\TimezonedDatetime;

class HabitEvent extends Model{
    use HasFactory;

    protected $fillable = ['note'];

    protected $casts = [
        'logged_at' => TimezonedDatetime::class,
    ];

    public function habit() : BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}