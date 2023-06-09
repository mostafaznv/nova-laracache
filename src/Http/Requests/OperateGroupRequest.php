<?php

namespace Mostafaznv\NovaLaraCache\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mostafaznv\NovaLaraCache\Rules\GroupRule;

class OperateGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group' => [
                'required', 'string', new GroupRule
            ],
        ];
    }
}
