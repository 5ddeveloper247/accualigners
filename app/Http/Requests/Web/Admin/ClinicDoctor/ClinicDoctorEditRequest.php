<?php

namespace App\Http\Requests\Web\Admin\ClinicDoctor;

use App\Models\ClinicDoctor;
use Illuminate\Foundation\Http\FormRequest;

class ClinicDoctorEditRequest extends FormRequest
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
            //
        ];
    }
}
