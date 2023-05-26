<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
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
                'judul' => 'required|unique:berita,judul',
                'slug' => 'required|unique:berita,slug',
                'deskripsi' => 'required|min:50|max:500',
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
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!!',
            'min:50' => 'Deskirpsi setidaknya memiliki 50 karakter',
            'max:500' => 'Deskripsi tidak boleh melebihi dari 500 karakter'
        ];
    }
}
