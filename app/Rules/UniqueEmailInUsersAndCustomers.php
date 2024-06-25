<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
use App\Models\Customer;

class UniqueEmailInUsersAndCustomers implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the email exists in the users table
        $existsInUsers = User::where('email', $value)->exists();

        // Check if the email exists in the customers table
        $existsInCustomers = Customer::where('email', $value)->exists();

        // The email should not exist in either table
        if ($existsInUsers || $existsInCustomers) {
            $fail('The :attribute has already been taken.');
        }
    }
}
