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
            'gelar' => 'required|in:SMA/SMK,D3,D4,S1,S2',
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'prestasi' => 'nullable|string|max:2000',
            'tahun_mulai' => 'required|in:2017,2018,2019,2020,2021,2022,2023,2024,2025,2026,2027,2028,2029',
            'tahun_berakhir' => 'required|in:2017,2018,2019,2020,2021,2022,2023,2024,2025,2026,2027,2028,2029,2030,Saat Ini',
            'ipk' => 'nullable|numeric|between:0,4',
        ];
    }

    public function messages()
    {
        return [
            'gelar.required' => 'Gelar Tidak Boleh Kosong',
            'gelar.in' => 'Gelar Hanya Pada Pilihan',
            'institusi.required' => 'Institusi Tidak Boleh Kosong',
            'institusi.max' => 'Nama Institusi Melebihi Batas Maksimal',
            'jurusan.required' => 'Jurusan Tidak Boleh Kosong',
            'jurusan.max' => 'Nama Jurusan Melebihi Batas Maksimal',
            'prestasi.max' => 'Inputan Prestasi Melebihi Batas Maksimal',
            'tahun_mulai.required' => 'Tahun Mulai Tidak Boleh Kosong',
            'tahun_mulai.in' => 'Tahun Hanya Pada Pilihan',
            'tahun_berakhir.required' => 'Tahun Berakhir Tidak Boleh Kosong',
            'tahun_berakhir.in' => 'Tahun Hanya Pada Pilihan',
            'ipk.numeric' => 'Inputan IPK harus berupa angka',
            'ipk.between' => 'Inputan IPK harus berada dalam rentang 0 hingga 4',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tahunMulai = $this->input('tahun_mulai');
            $tahunBerakhir = $this->input('tahun_berakhir');

            // Memeriksa apakah tahun mulai lebih besar dari tahun berakhir
            if ($tahunMulai > $tahunBerakhir) {
                $validator->errors()->add('tahun_mulai', 'Tahun Mulai Tidak Boleh Lebih Besar Dari Tahun Berakhir');
            }
        });
    }
}
