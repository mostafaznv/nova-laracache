<?php

namespace Mostafaznv\NovaLaraCache\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ModelRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $model = urldecode($value);

        if (!class_exists($model) or !method_exists($model, 'cacheEntities')) {
            $fail('The :attribute is not a valid model.');
        }
    }
}
