<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_start' => 'required',
            'time_start' => 'required',
            'date_end' => 'required',
            'time_end' => 'required',
            'trip_start' => [
                // format must be like 'Tue, Nov 21, 2017 03:00 PM'
                new \App\Rules\DateRules\CheckDateFormat(),
                // if trip_start < now
                'after:now',                            
            ],
            'trip_end' => [
                new \App\Rules\DateRules\CheckDateFormat(),
                // if trip_start > trip_end
                'after:trip_start', 
                // if interval between dates < 24 hours
                new \App\Rules\DateRules\MinIntervalBetweenDates($this->trip_start),
                // If another trip is already booked for this time
                new \App\Rules\DateRules\AnotherTripAlreadyBooked($this->product, $this->trip_start, $this->trip_end),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'trip_start' => $this->date_start . ' ' . $this->time_start,
            'trip_end' => $this->date_end . ' ' . $this->time_end
        ]);
    }
}
