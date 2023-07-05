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
            'jabatan' => 'required|max:60',
            'tempat_lahir' => 'required|max:70',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|max:40',
            'status_kawin' => 'required|max:40',
            'jumlah_anak' => 'required',
            'pendidikan_terakhir' => 'required|max:100',
            'alamat' => 'required|max:255',
            'perusahaan_organisasi.*' => 'required|max:255',
            'jabatan_kerja.*' => 'required|max:100',
            'jabatan_kerja.*' => 'required|max:100',
            'tahun_mulai.*' => 'required|max:4',
            'tahun_selesai.*' => 'required|max:4',
            'jenjang.*' => 'required|max:100',
            'institusi_pendidikan.*' => 'required|max:100',
            'tahun_lulus.*' => 'required|max:4',
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'unique' => 'Sudah terdapat judul berita dengan nama yang sama'
            ],
        ];
    }
}
