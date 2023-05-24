<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

use Illuminate\Foundation\Http\FormRequest;

class CaseImpressionKitReceivedRequest extends FormRequest
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
            'impression_kit_received' => 'required|in:1,0'
        ];
    }
}
