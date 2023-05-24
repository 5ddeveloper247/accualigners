<?php

namespace App\Http\Requests\Web\Admin\Shipping\Charge;

use App\Models\ShippingCompanyCharge;
use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyChargeEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ShippingCompanyCharge::where('id', $this->route('charge'))->exists();
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
