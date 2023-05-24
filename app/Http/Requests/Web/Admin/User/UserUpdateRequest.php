<?php

namespace App\Http\Requests\Web\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', $this->route('user'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user').',id',
            'password' => 'nullable|min:6|confirmed',
            'picture' => 'sometimes|nullable|mimes:png,jpg',
            'role_id' => 'required|exists:roles,id'
        ];
    }
}
