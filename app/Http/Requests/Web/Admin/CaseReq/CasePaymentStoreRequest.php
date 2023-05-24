<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

use App\Models\CaseModel;
use Illuminate\Foundation\Http\FormRequest;

class CasePaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CaseModel::where('id', $this->route('case'))->where('processing_fee_paid', '!=', 1)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stripeToken' => 'required'
        ];
    }
}
