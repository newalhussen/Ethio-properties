<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove any non-digit characters from the input
        $value = preg_replace('/[^0-9]/', '', $value);

        // Check if the phone number matches the desired format
        return preg_match('/^(0|\\+251)(7|9)\d{8}$/', $value);
    }

    public function message()
    {
        return 'The phone number must be in the format "+251" or "0" as country code, followed by either 7 or 9, and then 8 digits.';
    }
}
