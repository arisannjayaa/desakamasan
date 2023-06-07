<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KategoriProdukRequest extends FormRequest
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
        $id = $this->segment(3);
        return [
            'nama' => [
                'required',
                Rule::unique('kategori_produk', 'nama')->ignore($id)
            ],
            'slug' => [
                'required',
                Rule::unique('kategori_produk', 'slug')->ignore($id)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'unique' => 'Sudah terdapat nama kategori produk dengan nama yang sama'
            ],
            'slug' => [
                'required' => 'Slug tidak boleh kosong',
                'unique' => 'Sudah terdapat slug kategori produk dengan nama yang sama'
            ]
        ];
    }
}
