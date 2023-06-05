<?php

namespace Mostafaznv\NovaLaraCache\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mostafaznv\NovaLaraCache\Rules\EntityRule;
use Mostafaznv\NovaLaraCache\Rules\ModelRule;

class OperateCacheEntityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model' => [
                'required', 'string', new ModelRule
            ],

            'entities' => [
                'sometimes', 'required', 'array',
            ],

            'entities.*' => [
                'required', 'string', new EntityRule,
            ]
        ];
    }

    public function passedValidation(): void
    {
        $this->merge([
            'model'  => urldecode($this->post('model')),
            'entity' => $this->entities()
        ]);
    }

    private function entities(): array
    {
        $entities = [];

        foreach ($this->post('entities') as $entity) {
            $entities[] = urldecode($entity);
        }

        return $entities;
    }
}
