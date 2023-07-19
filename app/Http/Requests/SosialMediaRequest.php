<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SosialMediaRequest extends FormRequest
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
                Rule::unique('sosial_media', 'nama')->ignore($id),
                'max:100'
            ],
            'url' => [
                'required',
                Rule::unique('sosial_media', 'url')->ignore($id),
                'max:100',
                'starts_with:https://www.'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama' => [
                'required' => 'Nama tidak boleh kosong',
                'unique' => 'Sudah terdapat nama sosial media dengan nama yang sama',
                'max' => 'Nama tidak boleh melebih dari 100 karakter'
            ],
            'url' => [
                'required' => 'Url tidak boleh kosong',
                'unique' => 'Sudah terdapat Url sosial media dengan nama yang sama',
                'max' => 'Url tidak boleh melebih dari 100 karakter',
                'starts_with' => 'Url harus diawali dengan https://www.'
            ],
        ];
    }
}
