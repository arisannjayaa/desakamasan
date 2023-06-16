<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email:dns','unique:users'],
            'pass' => ['required', 'min:6', 'max:255'],
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required' => 'Email wajib diisi',
            'pass.required' => 'Password harus diisi',
        ];
    }
}