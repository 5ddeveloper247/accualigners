<?php

namespace App\Http\Requests\Web\Admin\Patient;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class PatientEditRequest extends FormRequest
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
            //
        ];
    }
}
