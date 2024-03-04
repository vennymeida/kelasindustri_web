<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perusahaans')->insert([
            [
                'user_id' => '3',
                'nama_pemilik' => 'Surabaya',
                'surat_mou' => 'surabaya',
                'nama_perusahaan' => 'PT Elnusa',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'vnymeida@gmail.com',
                'alamat_perusahaan' => 'jln griya',
                'deskripsi' => 'hahaha',
                'no_telp' => '0823212312123',
                'website' => '',
                'status' => 'unbanned',
            ],
            [
                'user_id' => '3',
                'nama_pemilik' => 'Venny',
                'surat_mou' => '2321232312',
                'nama_perusahaan' => 'PT Berjuang Skripsi',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'vnymeida@gmail.com',
                'alamat_perusahaan' => 'jln perusahaan',
                'deskripsi' => 'hahaha',
                'no_telp' => '0823212314',
                'website' => '',
                'status' => 'unbanned',
            ],

        ]);
    }
}
