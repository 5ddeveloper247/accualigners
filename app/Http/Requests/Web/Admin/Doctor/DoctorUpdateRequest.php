<?php

namespace App\Http\Requests\Web\Admin\Doctor;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class DoctorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', $this->route('doctor'))->exists();

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
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('doctor').',id',
            'password' => 'nullable|min:6|confirmed',
            'picture' => 'sometimes|nullable|mimes:png,jpg',
        ];
    }
}
