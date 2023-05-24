<?php

namespace App\Http\Requests\Api\Patient\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StartAppointmentRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'appointment_id' => 'required|exists:appointments,id,patient_id,'.$this->user()->id
        ];
    }

    public function messages()
    {
        return [
            'appointment_id.exists' => 'Appointment not found'
        ];
    }
}
