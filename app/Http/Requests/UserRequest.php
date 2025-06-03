<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'name' => 'required',
           'email' => 'nullable|required_without:mobile|regex:/^[\w\.\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,6}$/|unique:users,email,' . ($this->user ? $this->user->id : ''),
           'mobile' => 'nullable|required_without:email|regex:/^\+91\d{10}$/|unique:users,mobile,' . ($user ? $user->id : 'NULL') . ',id',
           'password' => 'required',
        ];
    }
}