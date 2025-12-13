<?php

namespace App\Http\Requests\Admin;

use App\Rules\ImageArrayRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:200',
            'slug' => 'required|max:200',
            'product_type' => 'required',
            'product_image' => 'required|image|mimes:jpg,png|max:2048',
            'other_image' => [new ImageArrayRule()],
        ];

        if ($this->input('product_type') == SINGLE_PRODUCT) {
            $rules = array_merge($rules, [
                'sku' => 'nullable|max:30',
                'price' => 'required|numeric|min:0',
                'sale_price' => 'nullable|numeric|min:0|lt:price',
                'stock_quantity' => 'required|integer|min:0',
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'tên sản phẩm',
            'slug' => 'slug',
            'product_type' => 'loại sản phẩm',
            'product_image' => 'ảnh đại diện sản phẩm',
            'other_image' => 'Ảnh bổ sung',
            'sku' => 'mã sản phẩm',
            'price' => 'giá gốc',
            'sale_price' => 'giá khuyến mãi',
            'stock_quantity' => 'số lượng tồn',
        ];
    }
}
