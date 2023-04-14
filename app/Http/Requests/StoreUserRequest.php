<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users|max:254',
            'password' => 'required|string|min:8',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:200',
            'gender' => 'nullable|in:nam,nữ',
            'birthday' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'phone_number.max' => 'Số điện thoại không được vượt quá :max ký tự',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự',
            'gender.in' => 'Giới tính không hợp lệ',
            'birthday.date' => 'Ngày sinh không đúng định dạng',
            'image.image' => 'Ảnh không đúng định dạng',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB',
        ];
    }
}
