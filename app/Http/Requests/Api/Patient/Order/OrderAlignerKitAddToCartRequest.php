<?php

namespace App\Http\Requests\Api\Patient\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderAlignerKitAddToCartRequest extends FormRequest
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
            'case_id' => 'required|exists:cases,id,no_of_trays,!NULL,aligner_kit_order_id,NULL',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_no' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'case_id.exists' => 'Case may not exists, already ordered clears aligner or no of trays not defined'
        ];
    }
}
