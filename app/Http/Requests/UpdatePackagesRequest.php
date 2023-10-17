<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackagesRequest extends FormRequest
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
        $packageId = $this->route('package');
        // dd($packageId);
        return [
            'package_name' => ['required', 'unique:packages,package_name,' . $packageId, 'unique:products,product_name'],
            'product'  => ['required'],
            'price' => ['required']
        ];
    }
}
