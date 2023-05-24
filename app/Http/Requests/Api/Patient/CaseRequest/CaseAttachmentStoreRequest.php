<?php

namespace App\Http\Requests\Api\Patient\CaseRequest;

use Illuminate\Foundation\Http\FormRequest;

class CaseAttachmentStoreRequest extends FormRequest
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
            'attachment_type' => 'required|in:IMAGE,X_RAY,UPPER_JAW,LOWER_JAW,OTHER',
            'attachment' => 'required|mimetypes:image/*,application/pdf,application/msword',
            'sort_order' => 'required|numeric'
        ];
    }
}
