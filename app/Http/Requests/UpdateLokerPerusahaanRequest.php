<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLokerPerusahaanRequest extends FormRequest
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
            'nama_loker' => 'required|regex:/^[A-Za-z\s]+$/',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'tipe_pekerjaan' => 'required',
            'keahlian' => 'required',
            'lokasi' => 'required|regex:/^[A-Za-z\s,]+$/',
            'gaji_bawah' => 'required',
            'gaji_atas' => 'required',
            'kuota' => 'required',
            'tgl_tutup' => [
                'required',
                // function ($attribute, $value, $fail) {
                //     $today = Carbon::now();
                //     $dateInput = Carbon::parse($value);

                //     if ($dateInput->isBefore($today)) {
                //         $fail(' tanggal tidak boleh kurang dari hari ini');
                //     }
                // },
            ],
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_loker.required' => 'Nama Loker tidak boleh kosong',
            'nama_loker.regex' => 'Nama Loker tidak boleh mengandung selain huruf',
            'deskripsi.required' => 'Diskripsi tidak boleh kosong',
            'persyaratan.required' => 'Persyaratan tidak boleh kosong',
            'tipe_pekerjaan.required' => 'Jenis Pekerjaan tidak boleh kosong',
            'keahlian.required' => 'Keahlian tidak boleh kosong',
            'lokasi.required' => 'Lokasi kerja tidak boleh kosong',
            'lokasi.regex' => 'Lokasi kerja tidak boleh mengandung selain huruf',
            'gaji_bawah.required' => 'Gaji tidak boleh kosong',
            'gaji_atas.required' => 'Gaji tidak boleh kosong',
            'kuota.required' => 'Kuota Karyawan tidak boleh kosong',
            'tgl_tutup.required' => 'Lowongan di tutup tidak boleh kosong',
            'status' => 'Status tidak boleh kosong',
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
