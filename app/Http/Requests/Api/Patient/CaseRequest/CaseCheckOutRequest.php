<?php

namespace App\Http\Requests\Api\Patient\CaseRequest;

use App\Models\CaseTimeLog;
use Illuminate\Foundation\Http\FormRequest;

class CaseCheckOutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return CaseTimeLog::where('case_time_logs.id', $this->route('case_time_log'))
        ->join('cases', 'cases.id', 'case_time_logs.case_id')
        ->where('cases.patient_id', $this->user()->id)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'check_out' => 'required|date'
        ];
    }
}
