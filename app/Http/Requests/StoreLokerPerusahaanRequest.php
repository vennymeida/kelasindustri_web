<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreLokerPerusahaanRequest extends FormRequest
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
            'id_kategori' => 'required|array|min:1',
            'id_keahlian' => 'required|array|min:1',
            'judul' => 'required|regex:/^[A-Za-z\s]+$/',
            'deskripsi' => 'required',
            'requirement' => 'required',
            'tipe_pekerjaan' => 'required',
            'min_pendidikan' => 'required',
            'min_pengalaman' => 'required',
            'lokasi' => 'required|regex:/^[A-Za-z\s,]+$/',
            'gaji_bawah' => 'required',
            'gaji_atas' => 'required',
            'jumlah_pelamar' => 'required',
            'tutup' => [
                'required',
                function ($attribute, $value, $fail) {
                    $today = Carbon::now();
                    $dateInput = Carbon::parse($value);

                    if ($dateInput->isBefore($today)) {
                        $fail(' tanggal tidak boleh kurang dari hari ini');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'id_kategori.min' => 'Pilih setidaknya satu kategori',
            'id_keahlian.required' => 'Keahlian tidak boleh kosong',
            'id_keahlian.min' => 'Pilih setidaknya satu keahlian',
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.regex' => 'Judul tidak boleh mengandung selain huruf',
            'deskripsi.required' => 'Diskripsi tidak boleh kosong',
            'requirement.required' => 'Persyaratan tidak boleh kosong',
            'tipe_pekerjaan.required' => 'Jenis Pekerjaan tidak boleh kosong',
            'min_pendidikan.required' => 'Minimal Pendidikan tidak boleh kosong',
            'min_pengalaman.required' => 'Minimal Pengalaman tidak boleh kosong',
            'lokasi.required' => 'Lokasi kerja tidak boleh kosong',
            'lokasi.regex' => 'Lokasi kerja tidak boleh mengandung selain huruf',
            'gaji_bawah.required' => 'Gaji tidak boleh kosong',
            'gaji_atas.required' => 'Gaji tidak boleh kosong',
            'jumlah_pelamar.required' => 'Jumlah Karyawan tidak boleh kosong',
            'tutup.required' => 'Lowongan di tutup tidak boleh kosong',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $gajiBawah = $this->input('gaji_bawah');
            $gajiAtas = $this->input('gaji_atas');

            if ($gajiBawah >= $gajiAtas) {
                $validator->errors()->add('gaji_bawah', 'Gaji yang dimasukkan tidak masuk akal');
                $validator->errors()->add('gaji_atas', 'Gaji yang dimasukkan tidak masuk akal');
            }
        });
    }
}
