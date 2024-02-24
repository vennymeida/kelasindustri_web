<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportKotaRequest extends FormRequest
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
        return [
            'import-file' => 'required|mimes:xlsx, csv, xls|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'import-file.mimes' => 'Tipe file yang dimasukkan salah',
            'import-file.required' => 'File excel tidak boleh kosong',
            'import-file.max' => 'File excel melebihi 10mb',
        ];
    }
}
