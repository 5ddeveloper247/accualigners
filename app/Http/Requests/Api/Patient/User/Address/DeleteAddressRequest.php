<?php

namespace App\Http\Requests\Api\Patient\User\Address;

use App\Models\PatientAddress;
use Illuminate\Foundation\Http\FormRequest;

class DeleteAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            //
        ];
    }
}
