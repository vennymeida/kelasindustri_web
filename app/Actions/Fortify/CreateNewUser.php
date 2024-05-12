<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $message = [
            'name.required' => 'Kolom nama lengkap harus diisi.',
            'name.string' => 'Kolom nama lengkap harus berupa teks.',
            'name.max' => 'Kolom nama lengkap tidak boleh lebih dari :max karakter.',
            'name.regex' => 'Kolom nama lengkap tidak boleh mengandung angka',

            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',

            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus memiliki setidaknya :min karakter.',

            'user_type.required' => 'Pilih jenis pengguna (Lulusan atau Perusahaan).',
            'user_type.in' => 'Jenis pengguna yang dipilih tidak valid.',

            'document.required_if' => 'Dokumen harus diunggah jika mendaftar sebagai Lulusan.',
            'document.mimes' => 'Dokumen harus berupa PDF atau gambar (jpg, jpeg, png).',
            'document.max' => 'Dokumen tidak boleh melebihi 10 MB.',
        ];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => $this->passwordRules(),
            'user_type' => ['required', Rule::in(['lulusan', 'perusahaan'])],
            'document' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:10240',
                Rule::requiredIf(function () use ($input) {
                    return isset($input['user_type']) && $input['user_type'] === 'lulusan';
                }),
            ],
        ], $message)->validate();
    
        $documentPath = null;
        if (isset($input['user_type']) && $input['user_type'] === 'lulusan' && isset($input['document'])) {
            $documentPath = $input['document']->store('documents', 'public');
        }
    
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'email_verified_at' => now(),
            'document' => $documentPath,
        ]);
    
        $roleName = ($input['user_type'] === 'perusahaan') ? 'Perusahaan' : 'Lulusan';
        $role = Role::where('name', $roleName)->first();
        $user->assignRole($role);
    
        return $user;
    }
    
}
