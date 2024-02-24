<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelatihanRequest extends FormRequest
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
            'nama_sertifikat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'penerbit' => 'required|string|max:255',
            'tanggal_dikeluarkan' => 'required|date',
            'sertifikat' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nama_sertifikat.required' => 'Nama Pelatihan/Sertifikat Tidak Boleh Kosong',
            'nama_sertifikat.max' => 'Inputan Nama Pelatihan/Sertifikat Melebihi Batas Maksimal',
            'deskripsi.max' => 'Inputan Deskripsi Melebihi Batas Maksimal',
            'penerbit.required' => 'Penerbit Tidak Boleh Kosong',
            'penerbit.max' => 'Inputan Penerbit Melebihi Batas Maksimal',
            'tanggal_dikeluarkan.required' => 'Tanggal Dikeluarkan Tidak Boleh Kosong',
            'sertifikat.required' => 'Sertifikat Tidak Boleh Kosong',
            'sertifikat.mimes' => 'Dokumen Hanya Mendukung Format pdf',
            'sertifikat.max' => 'Ukuran Dokumen Terlalu Besar',
        ];
    }
}
