<?php

namespace App\Models;

use App\Enums\Period;

use App\Models\Habit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HabitEvent extends Model{
    use HasFactory;

    protected $fillable = ['note'];

    public function habit() : BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
}