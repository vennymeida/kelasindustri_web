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
                'kota_id' => '1',
                'nama_pemilik' => 'Afrizal Himawan, S.Kom',
                'surat_mou' => '',
                'nama_perusahaan' => 'PT Hummatech Digital Indonesia',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'meidahersianty@gmail.com',
                'alamat_perusahaan' => 'Perum Permata Regency 1 Blok 10/28, Perun Gpa, Ngijo, Kec. Karang Ploso, Kabupaten Malang',
                'deskripsi' => 'PT Hummatech Digital Indonesia melayani jasa pengembangan perangkat lunak, baik berbasis desktop, web, dan mobile apps.',
                'no_telp' => '087656678987',
                'website' => 'www.hummatech.com',
                'status' => 'unbanned',
            ],
            [
                'user_id' => '5',
                'kota_id' => '1',
                'nama_pemilik' => 'Andika Pratama, S.Kom',
                'surat_mou' => '',
                'nama_perusahaan' => 'PT Get Aplikasi Indonesia',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'getaplikasi@gmail.com',
                'alamat_perusahaan' => 'Jl. Ngijo No.56, Karangploso, Kabupaten Malang',
                'deskripsi' => 'PT Get Aplikasi adalah perusahaan dibawah naungan PT Hummatech Digital Indonesia yang bergerak dibidang pembuatan perangkat keras',
                'no_telp' => '08567654567',
                'website' => 'www.getaplikasi.com',
                'status' => 'unbanned',
            ],
            [
                'user_id' => '6',
                'kota_id' => '1',
                'nama_pemilik' => 'Adi Jaya Putra S.Tr.Kom',
                'surat_mou' => '',
                'nama_perusahaan' => 'PT ACS Indonesia',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'acs@gmail.com',
                'alamat_perusahaan' => 'Jl.Mondoroko No.99, Singosari, Kabupaten Malang',
                'deskripsi' => 'Perusahaan ini bergerak pada bidang penyedia perangkat keras dan pembuatan perangkat lunak komputer',
                'no_telp' => '08567654567',
                'website' => 'www.acsindonesia.com',
                'status' => 'unbanned',
            ],
            [
                'user_id' => '7',
                'kota_id' => '1',
                'nama_pemilik' => 'abdhania',
                'surat_mou' => '',
                'nama_perusahaan' => 'yelss coffe',
                'logo_perusahaan' => '',
                'email_perusahaan' => 'smk8@gmail.com',
                'alamat_perusahaan' => 'JL. TELUK PACITAN ARJOSARI MALANGRT 7RW 5',
                'deskripsi' => 'ini adalah coffe shop',
                'no_telp' => '085730049937',
                'website' => 'www.youtube.com',
                'status' => 'unbanned',
            ],
        ]);
    }
}
