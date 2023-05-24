<?php

namespace App\Http\Requests\Web\Admin\CaseReq;

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
            // 'patient_id' => 'sometimes|nullable|nullable|exists:users,id',
            // 'clinic_doctor_id' => 'required|exists:clinic_doctors,id',
            'name' => 'required|max:255',
            'email' => 'sometimes|nullable|email|max:255',
            'phone_no' => 'sometimes|nullable|max:50',
            'gender' => 'sometimes|nullable|in:MALE,FEMALE,OTHER',
            'dob' => 'sometimes|nullable|date',
            'clinical_comment' => 'nullable',
            'prescription_comment' => 'nullable',
            'comment' => 'nullable',
            'impression_kit_order_id' => 'sometimes|nullable|nullable|exists:orders,id,product,"IMPRESSION KIT"',
            'clinical_conditions' => 'required',
            'clinical_conditions.*' => 'exists:clinical_conditions,id',
            'attachment_ids' => 'nullable',
            // 'jaw_lower' => 'required|mimetypes:image/*',
            // 'other_files.*' => 'mimetypes:image/*,application/pdf,application/msword',

        ];
    }
}
