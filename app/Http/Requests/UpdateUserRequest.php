<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:254|unique:users,email,' . $this->id,
            'password' => 'nullable|string|min:8',
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
            'name.required' => 'Vui lòng nhập tên người dùng.',
            'name.max' => 'Tên người dùng không được vượt quá :max ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
            'phone_number.max' => 'Số điện thoại không được vượt quá :max ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',
            'gender.in' => 'Vui lòng chọn giới tính.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',
            'image.image' => 'Vui lòng chọn file ảnh.',
            'image.max' => 'Kích thước ảnh không được vượt quá :max KB.',
        ];
    }

    public function updateUser($user)
    {
        // Update the name
        $user->name = $this->input('name');

        // Update the email
        $user->email = $this->input('email');

        // Update the password if it was changed
        $newPassword = $this->input('password');

        if ($newPassword) {
            $user->password = Hash::make($newPassword);
        }

        // Update the phone number if it has changed
        if ($this->input('phone_number') !== $user->phone_number) {
            $user->phone_number = $this->input('phone_number');
        }

        // Update the gender if it has changed
        if ($this->input('gender') !== $user->gender) {
            $user->gender = $this->input('gender');
        }

        // Update the birthday if it has changed
        if ($this->input('birthday') !== $user->birthday) {
            $user->birthday = $this->input('birthday');
        }

        // Update the address if it has changed
        if ($this->input('address') !== $user->address) {
            $user->address = $this->input('address');
        }

        // Handle avatar image upload
        if ($this->hasFile('image')) {
            $image = $this->file('image');
            $filename = time() . '.' . $image->extension();
            $image->move(public_path('images'), $filename);

            // Delete the previous image if it exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $user->image = "images/" . $filename;
        }

        // Save the changes to the user
        $user->save();
    }
}
