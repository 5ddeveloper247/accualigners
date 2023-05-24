<?php

namespace App\Http\Requests\Web\General\CaseReq;

use Illuminate\Foundation\Http\FormRequest;

class CaseUploadAttachmentRequest extends FormRequest
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
            
            'case_id' => 'sometimes|nullable|exists:cases,id',
            'attachment_type' => 'required|in:IMAGE,X_RAY,UPPER_JAW,LOWER_JAW,OTHER,TREATMENT-PLAN-PDF',
            'attachment' => 'required|mimetypes:image/*,application/pdf,application/msword,application/octet-stream,application/sla,application/vnd.ms-pki.stl,model/stl',
            'sort_order' => 'required|numeric'
        ];
    }
}
