<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'userName' => 'required|alpha_dash|min:4|exists:users,user_name',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'userName.required' => 'The username field is required.',
            'userName.alpha_dash' => 'The username may only contain letters, numbers, dashes, and underscores.',
            'userName.min' => 'The username must be at least :min characters.',
            'userName.exists' => 'The selected username isn\'t exist.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
