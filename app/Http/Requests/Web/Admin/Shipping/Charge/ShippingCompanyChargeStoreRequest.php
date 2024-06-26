<?php

namespace App\Http\Requests\Web\Admin\Shipping\Charge;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyChargeStoreRequest extends FormRequest
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
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'amount' => 'required|numeric|min:0',
            'duration_text' => 'required|max:225'
        ];
    }
}
