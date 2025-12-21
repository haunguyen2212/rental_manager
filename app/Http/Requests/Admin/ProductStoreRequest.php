<?php

namespace App\Http\Requests\Admin;

use App\Rules\ImageArrayRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
        $isDraft = $this->input('save_as_draft') == '1';
        
        // Base rules - make required fields optional for draft
        $rules = [
            'name' => 'required|max:200',
            'slug' => ($isDraft ? 'nullable|max:200' : 'required|max:200|unique:products,slug'),
            'product_type' => 'required|in:' . SINGLE_PRODUCT . ',' . VARIANT_PRODUCT,
            'product_image' => ($isDraft ? 'nullable' : 'required') . '|image|mimes:jpg,png|max:2048',
            'other_image' => [new ImageArrayRule()],
        ];

        if ($this->input('product_type') == SINGLE_PRODUCT) {
            $rules = array_merge($rules, [
                'sku' => ($isDraft ? 'nullable' : 'required') . '|max:30|unique:product_variants,sku',
                'price' => ($isDraft ? 'nullable' : 'required') . '|numeric|min:0',
                'sale_price' => 'nullable|numeric|min:0',
                'stock_quantity' => ($isDraft ? 'nullable' : 'required') . '|integer|min:0',
            ]);
        }
        else if ($this->input('product_type') == VARIANT_PRODUCT) {
            $rules = array_merge($rules, [
                'variant_name' => ($isDraft ? 'nullable' : 'required') . '|array',
                'variant_name.*' => ($isDraft ? 'nullable' : 'required') . '|max:200',
                'sku' => ($isDraft ? 'nullable' : 'required') . '|array',
                'sku.*' => ($isDraft ? 'nullable' : 'required') . '|max:30|unique:product_variants,sku',
                'price' => ($isDraft ? 'nullable' : 'required') . '|array',
                'price.*' => ($isDraft ? 'nullable' : 'required') . '|numeric|min:0',
                'sale_price' => 'nullable|array',
                'sale_price.*' => 'nullable|numeric|min:0',
                'stock_quantity' => ($isDraft ? 'nullable' : 'required') . '|array',
                'stock_quantity.*' => ($isDraft ? 'nullable' : 'required') . '|integer|min:0',
                'variant_image' => 'nullable|array',
                'variant_image.*' => 'nullable|image|mimes:jpg,png|max:2048',
                'display_flg' => 'nullable|array',
                'display_flg.*' => 'nullable|in:0,1',
            ]);
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $isDraft = $this->input('save_as_draft') == '1';
            
            // Skip validation for draft
            if ($isDraft) {
                return;
            }
            
            // Validate sale_price < price for SINGLE_PRODUCT
            if ($this->input('product_type') == SINGLE_PRODUCT) {
                $price = $this->input('price');
                $salePrice = $this->input('sale_price');
                
                if ($salePrice !== null && $price !== null && $salePrice >= $price) {
                    $validator->errors()->add(
                        "sale_price",
                        "Giá khuyến mãi phải nhỏ hơn giá gốc"
                    );
                }
            }
            // Validate sale_price < price for VARIANT_PRODUCT
            else if ($this->input('product_type') == VARIANT_PRODUCT) {
                $prices = $this->input('price', []);
                $salePrices = $this->input('sale_price', []);
                
                // Validate sale_price < price for each variant
                foreach ($salePrices as $index => $salePrice) {
                    if ($salePrice !== null && isset($prices[$index])) {
                        if ($salePrice >= $prices[$index]) {
                            $validator->errors()->add(
                                "sale_price.{$index}",
                                "Giá khuyến mãi phải nhỏ hơn giá gốc"
                            );
                        }
                    }
                }
            }
        });
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
            'sku.*' => 'mã sản phẩm',
            'price' => 'giá gốc',
            'price.*' => 'giá gốc',
            'sale_price' => 'giá khuyến mãi',
            'sale_price.*' => 'giá khuyến mãi',
            'stock_quantity' => 'số lượng tồn',
            'stock_quantity.*' => 'số lượng tồn',
            'variant_name' => 'tên biến thể',
            'variant_name.*' => 'tên biến thể',
            'variant_image' => 'ảnh đại diện biến thể',
            'variant_image.*' => 'ảnh đại diện biến thể',
            'display_flg' => 'trạng thái hiển thị',
            'display_flg.*' => 'trạng thái hiển thị',
        ];
    }
}
