<?php

namespace App\Http\Requests\Api\Patient\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderImpressionKitAddToCartRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_no' => 'required|max:50'
        ];
    }
}
