<?php

namespace App\Http\Requests\Api\Patient\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class GetAppointmentDetailRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
        // return Appointment::where('id', $this->route('appointment_id'))->where('patient_id', $this->user()->id)->count() > 0 ? true : false;
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
