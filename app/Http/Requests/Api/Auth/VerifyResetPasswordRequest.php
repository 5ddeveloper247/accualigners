<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyResetPasswordRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'otp' => 'required|min:5|max:5',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'User not found',
        ];
    }
}
