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
        ]);
    }
}
