<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubModuleRequest extends FormRequest
{
    /**
     * Determine if the module is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'module_id' => 'required|integer|exists:modules,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_modules', 'name')->ignore($this->route('sub_module')),
            ],
        ];
    }
}
