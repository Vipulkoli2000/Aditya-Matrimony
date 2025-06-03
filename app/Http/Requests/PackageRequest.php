<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:castes,name,'. ($this->package ? $this->package->id : ''),
            'description' => 'required',
            'price' => 'required|numeric',

        ];
        
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Package name is required',
            'name.unique' => 'Package already exist',
            'description' => 'description is required',
        ];
    }
}
