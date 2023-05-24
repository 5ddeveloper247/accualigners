<?php

namespace App\Http\Requests\Web\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'currency' => 'required|max:10',
            // 'impression_kit_price' => 'required|numeric|min:0',
            'aligner_kit_price' => 'required|numeric|min:0',
            // 'case_fee' => 'required|numeric|min:0',
            // 'home_impression_kit_enabled' => 'sometimes',
            // 'home_appointment_enabled' => 'sometimes',
            // 'home_i_am_candiate_enabled' => 'sometimes'
        ];
    }
}
