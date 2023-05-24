<?php

namespace App\Http\Requests\Api\Patient\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class GetClinicDoctorRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'clinic_id' => 'required|exists:clinics,id'
        ];
    }

    public function messages()
    {
        return [
            'clinic_id.exists' => 'Clinic does not exist'
        ];
    }
}
