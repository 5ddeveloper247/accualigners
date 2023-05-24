<?php

namespace App\Http\Requests\Web\Admin\Patient;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', $this->route('patient'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('patient').',id',
            'password' => 'nullable|min:6|confirmed',
            'picture' => 'sometimes|nullable|mimes:png,jpg',
            'clinic_doctor_id' => 'required|exists:clinic_doctors,id'
        ];
    }
}
