<?php

namespace App\Http\Requests\Web\Admin\ClinicDoctor;

use App\Models\ClinicDoctor;
use Illuminate\Foundation\Http\FormRequest;

class ClinicDoctorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ClinicDoctor::where('id', $this->route('doctor'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "doctor_id" => 'required|exists:users,id,user_type,doctor|unique:clinic_doctors,doctor_id,'.$this->route('doctor').',id,deleted_at,NULL,clinic_id,'.$this->route('clinic'),
            "appointment_duration" => 'nullable|numeric',
            "monday_time_from" => 'required_with:monday_time_to|nullable|date_format:"H:i"',
            "monday_time_to" => 'required_with:monday_time_from|nullable|date_format:"H:i"',
            "tuesday_time_from" => 'required_with:tuesday_time_to|nullable|date_format:"H:i"',
            "tuesday_time_to" => 'required_with:tuesday_time_from|nullable|date_format:"H:i"',
            "wednesday_time_from" => 'required_with:wednesday_time_to|nullable|date_format:"H:i"',
            "wednesday_time_to" => 'required_with:wednesday_time_from|nullable|date_format:"H:i"',
            "thursday_time_from" => 'required_with:thursday_time_to|nullable|date_format:"H:i"',
            "thursday_time_to" => 'required_with:thursday_time_from|nullable|date_format:"H:i"',
            "friday_time_from" => 'required_with:friday_time_to|nullable|date_format:"H:i"',
            "friday_time_to" => 'required_with:friday_time_from|nullable|date_format:"H:i"',
            "saturday_time_from" => 'required_with:saturday_time_to|nullable|date_format:"H:i"',
            "saturday_time_to" => 'required_with:saturday_time_from|nullable|date_format:"H:i"',
            "sunday_time_from" => 'required_with:sunday_time_to|nullable|date_format:"H:i"',
            "sunday_time_to" => 'required_with:sunday_time_from|nullable|date_format:"H:i"'
        ];
    }

    public function messages()
    {
        return [
            'doctor_id.exists' => 'Doctor not found',
            'doctor_id.unique' => 'Doctor already exists',
        ];
    }
}
