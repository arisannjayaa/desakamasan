<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDaerahRequest extends FormRequest
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
            'nama' => 'required|unique:daerah_wisata,nama|max:255',
            'slug' => 'required|unique:daerah_wisata,slug|max:255',
            'deskripsi' => 'required|max:1500',
            'alamat' => 'required|min:10|max:60',
            'telepon' => 'required|min:8|max:20',
            'fasilitas' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'kategori' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'unique:daerah_wisata,nama' => 'Sudah terdapat nama daerah dengan nama yang sama',
                'max:255' => 'Nama tidak boleh melebih dari 255 karakter'
            ],
            'slug' => [
                'required' => 'Slug tidak boleh kosong',
                'unique:daerah_wisata,slug' => 'Sudah terdapat slug daerah dengan nama yang sama',
                'max:255' => 'Slug tidak boleh melebih dari 255 karakter'
            ],
            'deskripsi' => [
                'required' => 'Deskripsi tidak boleh kosong',
                'max:1500' => 'Deskripsi tidak boleh melebihi dari 500 karakter'
            ],
            'alamat' => [
                'required' => 'Alamat tidak boleh kosong',
                'min:10' => 'Alamat setidaknya memiliki 10 karakter',
                'max:60' => 'Alamat tidak boleh melebihi dari 60 karakter'
            ],
            'telepon' => [
                'required' => 'Telepon tidak boleh kosong',
                'min:6' => 'Telepon setidaknya memiliki 6 karakter',
                'max:20' => 'Telepon tidak boleh melebihi dari 20 karakter'
            ],
            'fasilitas' => [
                'required' => 'Fasilitas tidak boleh kosong',
            ],
            'longitude' => [
                'required' => 'Longitude tidak boleh kosong',
            ],
            'latitude' => [
                'required' => 'Latitude tidak boleh kosong',
            ],
            'kategori' => [
                'required' => 'kategori tidak boleh kosong',
            ]
        ];
    }
}
