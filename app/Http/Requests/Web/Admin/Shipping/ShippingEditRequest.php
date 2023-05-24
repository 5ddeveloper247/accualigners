<?php

namespace App\Http\Requests\Web\Admin\Shipping;

use App\Models\ShippingCompany;
use Illuminate\Foundation\Http\FormRequest;

class ShippingEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ShippingCompany::where('id', $this->route('shipping'))->exists();

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
