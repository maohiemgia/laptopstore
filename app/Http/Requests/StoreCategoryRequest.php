<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories|min:1|max:60|regex:/^[a-zA-Z0-9\s\p{L}]+$/u'
        ];
    }

    /**
     * Get the custom messages for the validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Cần nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục tối đa 60 ký tự.',
            'name.regex' => 'Tên danh mục chỉ chứa chữ cái hoặc số.',
        ];
    }
}
