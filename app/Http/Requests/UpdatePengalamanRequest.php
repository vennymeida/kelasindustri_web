<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengalamanRequest extends FormRequest
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
            'nama_pekerjaan' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:2000',
            'tipe' => 'required|in:Fulltime,Parttime,Freelance,Internship',
            'gaji' => ['nullable', 'regex:/^\d{1,8}$/', 'max:8'],
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }

    public function messages()
    {
        return [
            'nama_pekerjaan.required' => 'Nama Pekerjaan Tidak Boleh Kosong',
            'nama_pekerjaan.max' => 'Inputan Nama Pekerjaan Melebihi Batas Maksimal',
            'nama_perusahaan.required' => 'Nama Perusahaan Tidak Boleh Kosong',
            'nama_perusahaan.max' => 'Inputan Nama Perusahaan Melebihi Batas Maksimal',
            'alamat.max' => 'Inputan Alamat Melebihi Batas Maksimal',
            'tipe.required' => 'Tipe Tidak Boleh Kosong',
            'tipe.in' => 'Inputan Tipe Hanya Pada Pilihan',
            'gaji.regex' => 'Inputan Gaji Maximal Puluhan Juta. Contoh Masukkan 50000000 tanpa titik/koma',
            'gaji.max' => 'Inputan Gaji Melebihi Batas Maksimal',
            'tanggal_mulai.required' => 'Tanggal Mulai Tidak Boleh Kosong',
            'tanggal_mulai.date' => 'Pilih Tanggal',
            'tanggal_berakhir.required' => 'Tanggal Berakhir Tidak Boleh Kosong',
            'tanggal_berakhir.after_or_equal' => 'Tanggal Berakhir Tidak Boleh Kurang Dari Tanggal Mulai',
            'tanggal_berakhir.date' => 'Pilih Tanggal',
        ];
    }
}
