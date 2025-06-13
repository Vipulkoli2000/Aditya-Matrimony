<?php

namespace App\Http\Requests\Default;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $id = auth()->user()->profile->id;
        $userId = auth()->user()->id;
        return [
            'user_id' => 'nullable|exists:users,id',
            'first_name' => 'nullable|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'mother_tongue' => 'nullable|string|max:100',
            'native_place' => 'nullable|string|max:100',
            'gender' => 'nullable|string|max:50',
            'marital_status' => 'nullable|string|max:50',
            'living_with' => 'nullable|string|max:100',
            'available_tokens' => 'nullable|integer|min:0',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'body_type' => 'nullable|string|max:50',
            'complexion' => 'nullable|string|max:50',
            'physical_abnormality' => 'nullable|boolean',
            'spectacles' => 'nullable|boolean',
            'lens' => 'nullable|boolean',
            'eating_habits' => 'nullable|string|max:100',
            'drinking_habits' => 'nullable|string|max:100',
            'smoking_habits' => 'nullable|string|max:100',
            'about_self' => 'nullable|string',
            'religion' => 'nullable|string|max:100',
            'caste' => 'nullable|integer',
            'sub_caste' => 'nullable|integer',
            'gotra' => 'nullable|string|max:100',
            'father_is_alive' => 'nullable|boolean',
            'father_name' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'father_organization' => 'nullable|string|max:100',
            'father_job_type' => 'nullable|string|max:100',
            'father_mobile' => 'nullable|string|max:15',
            'father_address' => 'nullable|string',
            'mother_is_alive' => 'nullable|boolean',
            'mother_name' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'mother_organization' => 'nullable|string|max:100',
            'mother_job_type' => 'nullable|string|max:100',
            'mother_mobile' => 'nullable|string|max:15',
            'mother_address' => 'nullable|string',
            'number_of_brothers_married' => 'nullable|integer',
            'number_of_brothers_unmarried' => 'nullable|integer',
            'brother_resident_place' => 'nullable|string|max:100',
            'number_of_sisters_married' => 'nullable|integer',
            'number_of_sisters_unmarried' => 'nullable|integer',
            'sister_resident_place' => 'nullable|string|max:100',
            'about_parents' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'birth_time' => 'nullable|string|max:50',
            'birth_place' => 'nullable|string|max:100',
            'highest_education' => 'nullable|string|max:100',
            'education_in_detail' => 'nullable|string',
            'additional_degree' => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:100',
            'organization' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'job_location' => 'nullable|string|max:100',
            'job_experience' => 'nullable|string|max:100',
            'income' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address_line_1' => 'nullable|string',
            'address_line_2' => 'nullable|string',
            'landmark' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'landline' => 'nullable|string|max:15',
            'email' => 'nullable|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/|email|max:100|unique:users,email,' . $userId,
            'partner_min_age' => 'nullable|integer|min:0',
            'partner_max_age' => 'nullable|integer|min:0',
            'partner_min_height' => 'nullable|string|max:50',
            'partner_max_height' => 'nullable|string|max:50',
            'partner_income' => 'nullable|numeric|min:0',
            'partner_currency' => 'nullable|string|max:50',
            'want_to_see_patrika' => 'nullable|string|max:100',
            'partner_sub_cast' => 'nullable|string|max:100',
            'partner_eating_habbit' => 'nullable|string|max:100',
            'partner_city_preference' => 'nullable|string|max:100',
            'partner_education' => 'nullable|string|max:100',
            'partner_education_specialization' => 'nullable|string|max:100',
            'partner_job' => 'nullable|string|max:100',
            'partner_business' => 'nullable|string|max:100',
            'partner_foreign_resident' => 'nullable|string|max:100',
            'when_meet' => 'nullable|boolean',
            'rashee' => 'nullable|string|max:50',
            'nakshatra' => 'nullable|string|max:50',
            'mangal' => 'nullable|string|max:50',
            'charan' => 'nullable|string|max:50',
            'gana' => 'nullable|string|max:50',
            'nadi' => 'nullable|string|max:50',
            'chart' => 'nullable|string|max:50',
            'more_about_patrika' => 'nullable|string',
            'celestial_bodies' => 'nullable|string|max:50',
            
        ];
    }
}