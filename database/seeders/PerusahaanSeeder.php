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
        DB::table('perusahaan')->insert([
            [
                'user_id' => '2',
                'kota_id' => '3',
                'nama_pemilik' => 'Meida',
                'surat_mou' => 'surabaya',
                'nama_perusahaan' => 'PT Hummasoft Technology',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'vnymeida@gmail.com',
                'alamat_perusahaan' => 'jln griya',
                'deskripsi' => 'hahaha',
                'no_telp' => '0823212312123',
                'website' => 'www.hummatech.com',
                'status' => 'unbanned',
            ],
        ]);
    }
}
