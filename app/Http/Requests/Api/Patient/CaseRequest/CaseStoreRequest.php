<?php

namespace App\Http\Requests\Api\Patient\CaseRequest;

use Illuminate\Foundation\Http\FormRequest;

class CaseStoreRequest extends FormRequest
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
            'phone_no' => 'required|max:50',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'dob' => 'required|date',
            'clinical_comment' => 'nullable',
            'arch_to_treat' => 'required|in:UPPER,LOWER',
            'a_p_relationship' => 'required|in:MAINTAIN,IMPROVE',
            'overjet' => 'required|in:MAINTAIN,IMPROVE',
            'overbite' => 'required|in:MAINTAIN,IMPROVE',
            'midline' => 'required|in:MAINTAIN,IMPROVE',
            'prescription_comment' => 'nullable',
            'comment' => 'nullable',
            'processing_fee_amount' => 'required|numeric',
            'impression_kit_order_id' => 'required|exists:orders,id,product,"IMPRESSION KIT"',
            'clinical_conditions' => 'required',
            'clinical_conditions.*' => 'exists:clinical_conditions,id',
            'attachments' => 'required',
            'attachments.*' => 'exists:case_attachments,id,case_id,NULL',
            // 'jaw_lower' => 'required|mimetypes:image/*',
            // 'other_files.*' => 'mimetypes:image/*,application/pdf,application/msword',

        ];
    }
}
