<?php

namespace App\Rules\DateRules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class MinIntervalBetweenDates implements Rule
{
    protected $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        $this->date = new Carbon($date);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $date = new Carbon($value);

        if ($this->date->diffInHours($date) < 24) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Minimum rental period 24 hours.';
    }
}
