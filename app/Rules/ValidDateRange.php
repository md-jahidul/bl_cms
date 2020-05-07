<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidDateRange implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $date_range_array = explode('-', $value);
        $start_date = Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[0]))->toDateTimeString();
        $end_date   =  Carbon::createFromFormat('Y/m/d h:i A', trim($date_range_array[1]))->toDateTimeString();

        return $start_date < $end_date;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'EndDate should be greater than StartDate';
    }
}
