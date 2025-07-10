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
        // Get the caste ID from the route if updating
        $casteId = $this->route('caste') ? $this->route('caste')->id : null;
        
        return [
            'name' => 'required|unique:castes,name,' . $casteId,
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
