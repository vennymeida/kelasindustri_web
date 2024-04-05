<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengalamanRequest extends FormRequest
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
            'nama_pengalaman' => 'required|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:2000',
            'tipe' => 'required|in:Fulltime,Parttime,Freelance,Internship,Lainnya',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ];
    }

    public function messages()
    {
        return [
            'nama_pengalaman.required' => 'Nama Pengalaman Tidak Boleh Kosong',
            'nama_pengalaman.max' => 'Inputan Nama Pengalaman Melebihi Batas Maksimal',
            'nama_instansi.required' => 'Nama Instansi Tidak Boleh Kosong',
            'nama_isntansi.max' => 'Inputan Nama Instansi Melebihi Batas Maksimal',
            'alamat.max' => 'Inputan Alamat Melebihi Batas Maksimal',
            'tipe.required' => 'Tipe Tidak Boleh Kosong',
            'tipe.in' => 'Inputan Tipe Hanya Pada Pilihan',
            'tgl_mulai.required' => 'Tanggal Mulai Tidak Boleh Kosong',
            'tgl_mulai.date' => 'Pilih Tanggal',
            'tgl_selesai.required' => 'Tanggal Berakhir Tidak Boleh Kosong',
            'tgl_selesai.after_or_equal' => 'Tanggal Berakhir Tidak Boleh Kurang Dari Tanggal Mulai',
            'tgl_selesai.date' => 'Pilih Tanggal',
        ];
    }
}
