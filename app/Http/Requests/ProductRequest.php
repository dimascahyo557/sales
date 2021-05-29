<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        ($this->method() === 'post') ? $unique = '' : $unique = ',' . $this->segment(2);

        return [
            'category' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'price' => 'required|numeric|integer',
            'sku' => 'required|max:50|unique:products,sku' . $unique,
            'status' => 'required|boolean',
            'image' => 'nullable|sometimes|image',
            'description' => 'nullable|sometimes|max:6500',
        ];
    }
}
