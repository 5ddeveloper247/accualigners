<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

use Illuminate\Foundation\Http\FormRequest;

class CaseNoOfTraysUpdateRequest extends FormRequest
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
            'case_id' => 'required|exists:cases,id',
            'no_of_trays' => 'required|numeric|min:0'
        ];
    }
}
