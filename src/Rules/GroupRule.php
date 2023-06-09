<?php

namespace Mostafaznv\NovaLaraCache\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GroupRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $groups = config('laracache.groups');

        if (!array_key_exists($value, $groups)) {
            $fail('The :attribute is not a valid group.');
        }
    }
}
