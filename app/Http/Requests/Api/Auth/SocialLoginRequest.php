<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SocialLoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            // 'picture' => 'nullable|url',
            // 'phone_no' => 'nullable',
            // 'dob' => 'nullable',
            'provider_id' => 'required',
            'provider_name' => 'required|in:facebook,gmail,apple',
        ];
    }
}
