<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
        return [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'tahun_terbit' => 'tahun terbit',
            'category_id' => 'kategori',
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
