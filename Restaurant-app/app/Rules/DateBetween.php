<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateBetween implements Rule
{
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value);
        $lastDate = Carbon::now()->addWeek(2);

        return $value >= now() && $value <= $lastDate;
    }

    public function message()
    {
        return 'Please choose a date between a week from now';
    }
}
