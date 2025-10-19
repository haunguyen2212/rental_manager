<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserSearchRequest extends FormRequest
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
            'name' => 'nullable|max:50',
            'email' => 'nullable|max:200',
            'phone' => 'nullable|max:10',
            'birthday' => 'nullable|date|date_format:Y/m/d|before_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên / tài khoản',
            'email' => 'email',
            'phone' => 'số điện thoại',
            'birthday' => 'ngày sinh',
        ];
    }

    public function messages()
    {
        return [
            'birthday.before_or_equal' => 'Vui lòng nhập ngày sinh hợp lệ.',
        ];
    }
}
