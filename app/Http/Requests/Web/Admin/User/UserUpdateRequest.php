<?php

namespace App\Http\Requests\Web\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', Auth::id())->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user =  Auth::user();

        return [

            'name' => 'required|min:3|max:100',
            'gender' => 'required',
            'phone' => 'required|min:10|max:20',
            'email' => 'required|email|max:100|unique:users,email,' . ($user ? $user->id : ''),
            'current_password' => [
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail(':attribute is Incorrect !');
                    }
                }
            ],
            'password_confirmation' => 'same:password'
        ];

    }
}
