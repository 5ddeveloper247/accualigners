<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

use App\Models\CaseModel;
use Illuminate\Foundation\Http\FormRequest;

class CaseOrderAlignerIndexRequest extends FormRequest
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
            //
        ];
    }
}
