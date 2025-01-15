<?php

namespace App\Models;
use App\Enums\Period;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habit extends Model{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['period','frequency','name'];
    protected $casts = ['period' => Period::class];

}