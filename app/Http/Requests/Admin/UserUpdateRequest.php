<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'username' => 'required|max:20|unique:users,username,' . $this->user,
            'name' => 'required|max:50',
            'password' => 'nullable|min:5|max:20',
            'role_id' => 'required|exists:roles,id',
            'birthday' => 'nullable|date|date_format:Y/m/d|before_or_equal:today',
            'email' => 'nullable|max:200|email|unique:users,email,' . $this->user,
            'phone' => 'nullable|digits:10|unique:users,phone,' . $this->user,
            'address' => 'nullable|max:500',
            'status' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'username'    => 'tài khoản',
            'name' => 'họ và tên',
            'password' => 'mật khẩu',
            'role_id' => 'vai trò',
            'birthday' => 'ngày sinh',
            'email' => 'email',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
            'status' => 'trạng thái'
        ];
    }

    public function messages()
    {
        return [
            'birthday.before_or_equal' => 'Vui lòng nhập ngày sinh hợp lệ.',
        ];
    }
}
