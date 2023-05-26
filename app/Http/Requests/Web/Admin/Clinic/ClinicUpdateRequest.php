<?php

namespace App\Http\Requests\Web\Admin\Clinic;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;

class ClinicUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:clinics,id,'.$this->route('ElementId'),
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|max:255',
            'contact_person_email' => 'required|email',
            'contact_person_number' => 'required|numeric|min:11',
        ];
    }
}
