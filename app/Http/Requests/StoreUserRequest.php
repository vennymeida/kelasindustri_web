<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'password' => 'required|min:8',
            'user_type' => ['required', Rule::in(['lulusan', 'perusahaan'])],
            'document' => [
                'nullable',  // Dapat kosong jika bukan lulusan
                'file',  // Harus berupa file
                'mimes:pdf,jpg,jpeg,png',  // Hanya menerima PDF atau gambar
                'max:10240',  // Batas ukuran 10 MB
                Rule::requiredIf($this->input('user_type') === 'lulusan'),  // Wajib jika tipe "Lulusan"
            ],
        ];

    }

    public function messages()
    {
        return [
            'document.required_if' => 'Dokumen harus diunggah jika mendaftar sebagai Lulusan.',
            'document.mimes' => 'Dokumen harus berupa PDF atau gambar (jpg, jpeg, png).',
            'document.max' => 'Dokumen tidak boleh melebihi 10 MB.',
        ];
    }
}
