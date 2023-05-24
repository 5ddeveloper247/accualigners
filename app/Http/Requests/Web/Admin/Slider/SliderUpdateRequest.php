<?php

namespace App\Http\Requests\Web\Admin\Slider;

use App\Models\Slider;
use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Slider::where('id', $this->route('slider'))->exists();
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
            'slider_image' => 'sometimes|nullable|mimes:png,jpg'
        ];
    }
}
