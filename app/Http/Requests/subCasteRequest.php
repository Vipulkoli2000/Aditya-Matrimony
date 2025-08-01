<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subCasteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:sub_castes,name,'. ($this->sub_caste ? $this->sub_caste->id : ''),
            'caste_id' => 'required|exists:castes,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'SubCaste name is required',
            'name.unique' => 'SubCaste already exist',
            'caste_id.required' => 'Please select a caste',
            'caste_id.exists' => 'Selected caste is invalid',
        ];
    }
}