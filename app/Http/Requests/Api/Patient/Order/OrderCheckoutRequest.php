<?php

namespace App\Http\Requests\Api\Patient\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderCheckoutRequest extends FormRequest
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
            'payment_name' => 'required'
        ];
    }
}
