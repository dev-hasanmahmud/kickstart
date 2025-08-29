<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;

class StorePermissionRequest extends FormRequest
{
    /**
     * Determine if the permission is authorized to make this request.
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
            'module_id' => 'required',
            'sub_module_id' => 'required',
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:permissions,name',
            'is_core' => 'nullable',
            'status' => ['nullable', Rule::in(array_keys(Status::options()))],
        ];
    }
}
