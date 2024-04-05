<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendidikanRequest extends FormRequest
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
            'tingkatan' => 'required|in:SMK,D3,D4,S1,S2',
            'nama_institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tahun_mulai' => 'required|in:2017,2018,2019,2020,2021,2022,2023,2024,2025,2026,2027,2028,2029',
            'tahun_selesai' => 'required|in:2017,2018,2019,2020,2021,2022,2023,2024,2025,2026,2027,2028,2029,2030,Saat Ini',
        ];
    }

    public function messages()
    {
        return [
            'tingkatan.required' => 'Gelar Tidak Boleh Kosong',
            'tingkatan.in' => 'Gelar Hanya Pada Pilihan',
            'nama_institusi.required' => 'Institusi Tidak Boleh Kosong',
            'nama_institusi.max' => 'Nama Institusi Melebihi Batas Maksimal',
            'jurusan.required' => 'Jurusan Tidak Boleh Kosong',
            'jurusan.max' => 'Nama Jurusan Melebihi Batas Maksimal',
            'tahun_mulai.required' => 'Tahun Mulai Tidak Boleh Kosong',
            'tahun_mulai.in' => 'Tahun Hanya Pada Pilihan',
            'tahun_selesai.required' => 'Tahun Selesai Tidak Boleh Kosong',
            'tahun_selesai.in' => 'Tahun Hanya Pada Pilihan',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tahunMulai = $this->input('tahun_mulai');
            $tahunSelesai = $this->input('tahun_selesai');

            // Memeriksa apakah tahun mulai lebih besar dari tahun selesai
            if ($tahunMulai > $tahunSelesai) {
                $validator->errors()->add('tahun_mulai', 'Tahun Mulai Tidak Boleh Lebih Besar Dari Tahun Selesai');
            }
        });
    }
}
