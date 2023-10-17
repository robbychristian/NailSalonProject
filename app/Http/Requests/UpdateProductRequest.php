<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product');

        return [
            'product_name' => ['required', 'unique:products,product_name,' . $productId,  'unique:packages,package_name'],
            'service_type' => ['required'],
            'price' => ['required'],
        ];
    }
}
