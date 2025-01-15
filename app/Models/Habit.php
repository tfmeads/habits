<?php

namespace App\Models;

use App\Enums\Period;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['period','frequency','name'];
    protected $casts = ['period' => Period::class];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function events() : HasMany
    {
        return $this->hasMany(HabitEvent::class);
    }
}