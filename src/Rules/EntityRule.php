<?php

namespace Mostafaznv\NovaLaraCache\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class EntityRule implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = false;
        $entity = urldecode($value);
        $model = app(urldecode($this->data['model']));

        foreach ($model->cacheEntities() as $e) {
            if ($e->name == $entity) {
                $exists = true;
            }
        }

        if (!$exists) {
            $fail('The :attribute is not a valid entity.');
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
