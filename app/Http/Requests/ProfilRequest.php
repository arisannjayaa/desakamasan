<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
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
            'nama' => 'required',
            'deskripsi' => 'required|min:50|max:15000',
            'visi' => 'required|max:15000',
            'misi' => 'required|max:15000',
            'gambar' => 'required',
            'video' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
            ],
            'deskripsi' => [
                'required' => 'Deskripsi tidak boleh kosong!!',
                'min' => 'Deskirpsi setidaknya memiliki 50 karakter',
                'max' => 'Deskripsi tidak boleh melebihi dari 15000 karakter'
            ] ,
            'visi' => [
                'required' => 'Visi tidak boleh kosong!!',
                'max' => 'Visi tidak boleh melebihi dari 15000 karakter',
            ],
            'misi' => [
                'required' => 'Misi tidak boleh kosong!!',
                'max' => 'Misi tidak boleh melebihi dari 15000 karakter',
            ],
            'gambar' => [
                'required' => 'Foto tidak boleh kosong',
            ],
            'video' => [
                'required' => 'Video tidak boleh kosong',
            ],
        ];
    }
}
