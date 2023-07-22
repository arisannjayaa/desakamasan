<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
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
            'telepon' => 'required',
            'alamat' => 'required|max:255',
            'email' => 'required|email',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'telepon' => [
                'required' => 'Telepon tidak boleh kosong',
            ],
            'alamat' => [
                'required' => 'Alamat tidak boleh kosong',
                'max' => 'Alamat tidak boleh melebihi dari 255 karakter'
            ],
            'email' => [
                'required' => 'Email tidak boleh kosong',
                'email' => 'Format email tidak susuai'
            ],
            'latitude' => [
                'required' => 'Latitude tidak boleh kosong',
            ],
            'longitude' => [
                'required' => 'Longitude tidak boleh kosong',
            ],
        ];
    }
}
