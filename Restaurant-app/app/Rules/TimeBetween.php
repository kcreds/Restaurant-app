<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
{
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value);
        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute);

        $earliestTime = Carbon::createFromTimeString('10:00');
        $lastTime = Carbon::createFromTimeString('23:00');

        return $pickupTime->between($earliestTime, $lastTime) ? true : false;
    }

    public function message()
    {
        return 'Please choose the time between 10:00-23:00';
    }
}
