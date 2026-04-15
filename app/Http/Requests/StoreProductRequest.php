<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk harus diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.min' => 'Nama produk minimal 3 karakter.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'qty.required' => 'Kuantitas harus diisi.',
            'qty.integer' => 'Kuantitas harus berupa angka bulat.',
            'qty.min' => 'Kuantitas minimal 1.',
            'price.required' => 'Harga harus diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama produk',
            'qty' => 'kuantitas',
            'price' => 'harga',
        ];
    }
}
