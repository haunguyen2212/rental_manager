<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
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
        return [
            'name' => 'nullable|max:200',
            'slug' => 'nullable|max:200',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'nullable|in:' . SINGLE_PRODUCT . ',' . VARIANT_PRODUCT,
            'status' => 'nullable|in:' . PRODUCT_STATUS_DRAFT . ',' . PRODUCT_STATUS_UN_PUBLIC . ',' . PRODUCT_STATUS_PUBLIC,
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên sản phẩm',
            'slug' => 'slug',
            'category_id' => 'danh mục',
            'type' => 'loại sản phẩm',
            'status' => 'trạng thái',
        ];
    }
}

