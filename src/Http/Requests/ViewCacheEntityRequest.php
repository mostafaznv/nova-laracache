<?php

namespace Mostafaznv\NovaLaraCache\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mostafaznv\NovaLaraCache\Rules\EntityRule;
use Mostafaznv\NovaLaraCache\Rules\ModelRule;

class ViewCacheEntityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model' => [
                'required', 'string', new ModelRule
            ],

            'entity' => [
                'required', 'string', new EntityRule,
            ]
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'model'  => urldecode($this->query('model')),
            'entity' => urldecode($this->query('entity'))
        ]);
    }
}
