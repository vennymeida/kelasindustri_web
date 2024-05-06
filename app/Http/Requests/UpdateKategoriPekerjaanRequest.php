<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriPekerjaanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('kategori')->id;
        return [
            'kategori' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:kategori_pekerjaans,kategori,' . $id
        ];
    }

    public function messages()
    {
        return [
            'kategori.required' => 'Data Kategori Tidak Boleh Kosong',
            'kategori.unique' => 'Data Kategori Sudah Tersedia',
            'kategori.regex' => 'Data Kategori Harus Kata',
        ];
    }
}
