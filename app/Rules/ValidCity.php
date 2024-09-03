<?php

namespace App\Rules;

use App\Models\City;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $index = explode('.', $attribute)[1];

        $address = request()->input("addresses.$index");

        $exists = City::where('country', $address['country'])
            ->where('zipCode', $address['zip'])
            ->where('name', $address['city'])
            ->exists();

        if (!$exists) {
            $fail("The combination of country, zip, and city does not exist in the database.");
        }
    }
}
