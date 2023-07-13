<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PerangkatDesaRequest extends FormRequest
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
            'nama' => 'required|max:255',
            'slug' => [
                'required',
                Rule::unique('pemerintah', 'slug')->ignore($id)
            ],
            'jabatan' => 'required|max:60',
            'tempat_lahir' => 'required|max:70',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:40',
            'status_kawin' => 'required|max:40',
            'pendidikan_terakhir' => 'required|max:100',
            'alamat' => 'required|max:255',
            'perusahaan_organisasi.*' => 'required|max:255',
            'tahun_mulai.*' => 'required|max:4',
            'tahun_selesai.*' => 'required|max:20',
            'jenjang.*' => 'required|max:100',
            'institusi_pendidikan.*' => 'required|max:100',
            'tahun_lulus.*' => 'required|max:4',
            'gambar' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'max' => 'Nama tidak boleh melebih dari 255 karakter'
            ],
            'slug' => [
                'required' => 'Slug tidak boleh kosong',
                'unique' => 'Sudah terdapat slug perangkat desa dengan nama yang sama'
            ],
            'jabatan' => [
                'required' => 'Jabatan tidak boleh kosong',
                'max' => 'Jabatan tidak boleh melebih dari 60 karakter'
            ],
            'tempat_lahir' => [
                'required' => 'Tempat lahir tidak boleh kosong',
                'max' => 'Tempat lahir tidak boleh melebih dari 70 karakter'
            ],
            'tanggal_lahir' => [
                'required' => 'Tanggal lahir tidak boleh kosong',
                'date' => 'Tanggal lahir harus berformat tanggal'
            ],
            'jenis_kelamin' => [
                'required' => 'Jenis kelamin tidak boleh kosong',
                'max' => 'Jenis kelamin tidak boleh melebih dari 40 karakter'
            ],
            'status_kawin' => [
                'required' => 'Status kawin tidak boleh kosong',
                'max' => 'Status kawin tidak boleh melebih dari 40 karakter'
            ],
            'pendidikan_terakhir' => [
                'required' => 'Pendidikan terakhir tidak boleh kosong',
                'max' => 'Pendidikan terakhir tidak boleh melebih dari 100 karakter'
            ],
            'alamat' => [
                'required' => 'Alamat tidak boleh kosong',
                'max' => 'Alamat tidak boleh melebih dari 255 karakter'
            ],
            'perusahaan_organisasi.*' => [
                'required' => 'Perusahaan organisasi tidak boleh kosong',
                'max' => 'Perusahaan organisasi tidak boleh melebih dari 255 karakter'
            ],
            'tahun_mulai.*' => [
                'required' => 'Tahun mulai tidak boleh kosong',
                'max' => 'Tahun mulai tidak boleh melebih dari 4 karakter'
            ],
            'tahun_selesai.*' => [
                'required' => 'Tahun selesai tidak boleh kosong',
                'max' => 'Tahun selesai tidak boleh melebih dari 20 karakter'
            ],
            'jenjang.*' => [
                'required' => 'Jenjang tidak boleh kosong',
                'max' => 'Jenjang tidak boleh melebih dari 100 karakter'
            ],
            'institusi_pendidikan.*' => [
                'required' => 'Institusi pendidikan tidak boleh kosong',
                'max' => 'Institusi pendidikan tidak boleh melebih dari 100 karakter'
            ],
            'tahun_lulus.*' => [
                'required' => 'Tahun lulus tidak boleh kosong',
                'max' => 'Tahun lulus tidak boleh melebih dari 4 karakter'
            ],
            'gambar' => [
                'required' => 'Foto tidak boleh kosong',
            ],
        ];
    }
}
