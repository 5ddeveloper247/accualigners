<?php

namespace App\Http\Requests\Api\Patient\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class AddPatientRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'clinic_doctor_id' => 'required|exists:clinic_doctors,id'
        ];
    }
}
