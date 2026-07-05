<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        
        return [
            'nama_kategori' => [
                'required','unique:categories,nama_kategori'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_kategori' => 'nama kategori',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka.',
            'unique' => ':attribute sudah digunakan.',
            'exists' => ':attribute tidak valid.',
            'max' => ':attribute maksimal :max.',
            'min' => ':attribute minimal :min.',
            'digits' => ':attribute harus terdiri dari :digits digit.',
        ];
    } 
}
