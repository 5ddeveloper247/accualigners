<?php

namespace App\Http\Requests\Web\Admin\Shipping;

use App\Models\ShippingCompany;
use Illuminate\Foundation\Http\FormRequest;

class ShippingUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|unique:shipping_companies,name,'.$this->route('shipping').',id,deleted_at,NULL',
        ];
    }
}
