<?php

namespace App\Http\Requests\Api\Doctor\Appointment;

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
            'appointment_id' => 'required|exists:appointments,id,doctor_id,'.$this->user()->id
        ];
    }

    public function messages()
    {
        return [
            'appointment_id.exists' => 'Appointment not found'
        ];
    }
}