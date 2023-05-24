<?php

namespace App\Http\Requests\Web\Admin\Appointment;

use App\Models\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Appointment::where('id', $this->route('appointment'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
