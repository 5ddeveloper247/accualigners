<?php

namespace App\Http\Requests\Web\Admin\Clinic;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;

class ClinicEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Clinic::where('id', $this->route('clinic'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
