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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:64',
            // 'email' => 'required|string|email|min:5|max:255|unique:users',
            // 'phone_number' => 'nullable|string|min:10|max:15',
            // 'gender' => 'nullable|string|min:2|max:10',
            // 'birthday' => 'nullable|date',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            // 'address' => 'nullable|string|max:255',
        ];
    }
}
