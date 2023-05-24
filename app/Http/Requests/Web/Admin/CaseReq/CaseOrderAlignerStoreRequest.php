<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

use App\Models\CaseModel;
use Illuminate\Foundation\Http\FormRequest;

class CaseOrderAlignerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CaseModel::where('id', $this->route('case'))->where(function($q){
            $q->whereNull('aligner_kit_order_id')->orWhere('aligner_kit_order_id', '');
        })
        ->whereNotNull('no_of_trays')->where('no_of_trays', '!=', '')->where('no_of_trays', '>', 0)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeToken' => 'required',
            // 'street1' => 'required|max:255',
            'address_id' => 'required|exists:addresses,id',
            // 'country_id' => 'required|exists:countries,id',
            // 'state_id' => 'required|exists:states,id',
            // 'city_id' => 'required|exists:cities,id',
            'shipping_company_charge_id' => '',
            // required|exists:shipping_company_charges,id
        ];
    }
}
