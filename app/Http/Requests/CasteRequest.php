<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasteRequest extends FormRequest
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
            'name' => 'required|unique:castes,name,'. ($this->cast ? $this->cast->id : ''),
        ];
        
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Cast name is required',
            'name.unique' => 'Cast already exist',
        ];
    }
}
