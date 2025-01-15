<?php

namespace App\Enums;

enum Period: string {
    case DAY  = 'Day';
    case WEEK = 'Week';
    case MONTH = 'Month';
    case YEAR = 'Year';


    public function getSortValue(){
        return [
            self::DAY->value => 1,
            self::WEEK->value => 2,
            self::MONTH->value => 3,
            self::YEAR->value => 4,
        ];
    }
}