<?php

namespace App\Http\Requests\Api\Patient\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AddAppointmentRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_difficulty' => 'required',
        ];
    }
}
