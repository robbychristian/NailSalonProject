<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'middle_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'last_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'birthday' => ['required'],
            'contact_no' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', Password::min(6)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
            'confirm_password' => ['required', 'same:password'],
            'street' => ['required'],
            'region' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],
            'postal_code' => ['required'],
        ];
    }
}
