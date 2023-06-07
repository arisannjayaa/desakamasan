<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
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
            'judul' => [
                'required',
                Rule::unique('berita', 'judul')->ignore($id)
            ],
            'slug' => [
                'required',
                Rule::unique('berita', 'slug')->ignore($id)
            ],
            'deskripsi' => 'required|min:50|max:15000',
            'kategori' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'judul' => [
                'required' => 'Judul tidak boleh kosong',
                'unique' => 'Sudah terdapat judul berita dengan nama yang sama'
            ],
            'slug' => [
                'required' => 'Slug tidak boleh kosong',
                'unique' => 'Sudah terdapat slug berita dengan nama yang sama'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi tidak boleh kosong!!',
                'min' => 'Deskirpsi setidaknya memiliki 50 karakter',
                'max' => 'Deskripsi tidak boleh melebihi dari 500 karakter'
            ] ,
            'kategori' => [
                'required' => 'Kategori tidak boleh kosong!!',
            ] ,
        ];
    }
}
