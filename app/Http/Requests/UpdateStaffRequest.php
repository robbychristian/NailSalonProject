<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
            // 'staff_name' => ['required'],
            'staff_image' => ['mimes:png,jpg,jpeg,gif', 'max:2048'],
            'services' => ['required'],
            'work_images.*' => ['mimes:png,jpg,jpeg,gif', 'max:2048'],
            // 'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            // 'middle_name' => ['regex:/^[\pL\s\-]+$/u'],
            // 'last_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
        ];
    }

    public function messages()
    {
        return [
            'staff_image.max' => 'The staff image must not be greater than 2MB.',
            'work_images.*.mimes' => 'The work image must be a file of type: png, jpg, jpeg, gif.',
            'work_images.*.max' => 'The work image must not be greater than 2MB.',
        ];
    }
}
