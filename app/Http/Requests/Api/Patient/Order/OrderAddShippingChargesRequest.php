<?php

namespace App\Http\Requests\Api\Patient\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderAddShippingChargesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Order::where('id', $this->route('order_id'))->where('patient_id', $this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping_company_charge_id' => 'required|exists:shipping_company_charges,id'
        ];
    }
}
