<?php

namespace App\Http\Requests\Api\Patient\User\Address;

use App\Models\PatientAddress;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true;
        return PatientAddress::where('id', $this->route('address'))->where('patient_id', $this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title' => 'required',
            'contact_no' => 'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required',
            'default' => 'required|in:1,0',
        ];
    }
}
