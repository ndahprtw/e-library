<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('category');
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email', Rule::unique('categories', 'nama_kategori')->ignore($user),
            'role' => 'required|exists:roles,name',
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
