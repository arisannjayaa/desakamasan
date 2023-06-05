<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DaerahRequest extends FormRequest
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
                Rule::unique('daerah', 'nama')->ignore($id),
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('daerah', 'slug')->ignore($id),
                'max:255'
            ],
            'deskripsi' => 'required|max:15000',
            'alamat' => 'required|min:10|max:60',
            'telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'longitude' => 'required',
            'latitude' => 'required',
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
            'telepon' => [
                'required' => 'Telepon tidak boleh kosong',
                'min' => 'Telepon setidaknya memliki 8 digit angka',
                'regex' => 'Telepon hanya boleh menggunakan angka'
            ],
            'longitude' => [
                'required' => 'Longitude tidak boleh kosong',
            ],
            'latitude' => [
                'required' => 'Latitude tidak boleh kosong',
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
