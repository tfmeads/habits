<?php

namespace App\Enums;

enum Period: string {
    case DAY  = 'Day';
    case WEEK = 'Week';
    case MONTH = 'Month';
    case YEAR = 'Year';
}