<?php

namespace Modules\Sys\app\Http\Requests;

use App\Http\Requests\ApiRequest;

class SysGroupRequest extends ApiRequest
{
    public function rules(): array
    {
        $rules = [];
        return $rules;
    }

    public function messages(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return true;
    }
}
