<?php

namespace App\Http\Requests\Api\Patient\Reports;

use App\Models\CaseModel;
use Illuminate\Foundation\Http\FormRequest;

class AverageReportByDaysRequest extends FormRequest
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
            'no_of_days' => 'required',
            'no_of_days.*' => 'required|numeric|min:1'
        ];
    }
}
