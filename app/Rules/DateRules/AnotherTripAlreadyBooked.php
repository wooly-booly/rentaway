<?php

namespace App\Rules\DateRules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Trip;
use Carbon\Carbon;

class AnotherTripAlreadyBooked implements Rule
{
    protected $productId;
    protected $tripStart;
    protected $tripEnd;
    protected $alreadyBookedTrip = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productId, $tripStart, $tripEnd)
    {
        $this->productId = $productId;
        $this->tripStart = (new Carbon($tripStart))->toDateTimeString();
        $this->tripEnd = (new Carbon($tripEnd))->toDateTimeString();
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
        $this->alreadyBookedTrip = Trip::where('product_id', $this->productId)
            ->where(function ($q) {
                $q->whereBetween('trip_start', [$this->tripStart, $this->tripEnd])
                    ->where('trip_start', '!=', $this->tripEnd);
            })->orWhere(function ($q) {
                $q->whereBetween('trip_end', [$this->tripStart, $this->tripEnd])
                ->where('trip_end', '!=', $this->tripStart);
            })->orWhere(function ($q) {
                $q->whereRaw('trip_start < ? and trip_end > ?', [$this->tripStart, $this->tripEnd]);
            })->first();

        if ($this->alreadyBookedTrip) {
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
        $tripStart = $this->dateFormat($this->alreadyBookedTrip->trip_start);
        $tripEnd = $this->dateFormat($this->alreadyBookedTrip->trip_end);

        return "Another trip ($tripStart - $tripEnd) already booked on this time.";
    }

    protected function dateFormat($date)
    {
        return (new Carbon($date))->toDayDateTimeString();
    }
}
