<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
        // dd($id);
        return [
            'nama' => [
                'required',
                Rule::unique('produk', 'nama')->ignore($id),
                'max:100'
            ],
            'slug' => [
                'required',
                Rule::unique('produk', 'slug')->ignore($id),
                'max:100'
            ],
            'deskripsi' => 'required|max:15000',
            'alamat' => 'required|min:10|max:60',
            'kategori' => 'required',
            'gambar' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'unique' => 'Sudah terdapat nama daerah dengan nama yang sama',
                'max' => 'Nama tidak boleh melebih dari 255 karakter'
            ],
            'slug' => [
                'required' => 'Slug tidak boleh kosong',
                'unique' => 'Sudah terdapat slug daerah dengan nama yang sama',
                'max' => 'Slug tidak boleh melebih dari 255 karakter'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi tidak boleh kosong',
                'max' => 'Deskripsi tidak boleh melebihi dari 500 karakter'
            ],
            'alamat' => [
                'required' => 'Alamat tidak boleh kosong',
                'min' => 'Alamat setidaknya memiliki 10 karakter',
                'max' => 'Alamat tidak boleh melebihi dari 60 karakter'
            ],
            'kategori' => [
                'required' => 'Kategori tidak boleh kosong',
            ],
            'gambar' => [
                'required' => 'Gambar tidak boleh kosong',
            ]
        ];
    }
}
