<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'zip' => 'required',
            'contact_person_name' => 'required',
            'contact_person_email' => 'required',
            'vat' => 'required',
            'clinic_name' => 'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6'
        ];
    }
}
