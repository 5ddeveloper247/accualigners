<?php

namespace App\Http\Requests\Web\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'sort_order' => 'required|numeric',
            'slider_image' => 'required|mimes:png,jpg'
        ];
    }
}
