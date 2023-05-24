<?php

namespace App\Http\Requests\Api\Patient\CaseRequest;

use App\Models\CaseModel;
use Illuminate\Foundation\Http\FormRequest;

class CaseCheckInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CaseModel::where('id', $this->route('case'))->where('patient_id', $this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tray_no' => 'required|numeric|min:1',
            'day' => 'required|numeric|min:1',
            // 'check_in' => 'required|date',
        ];
    }
}
