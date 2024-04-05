<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelatihans')->insert([
            [
                'user_id' => '3',
                'nama_sertifikat' => 'Sertifikasi Junior Frontend Developer',
                'deskripsi' => 'frontend',
                'sertifikat' => '',
                'penerbit' => 'PT Wijaya',
                'tgl_dikeluarkan' => Carbon::create('2000', '01', '01'),
            ],
            [
                'user_id' => '3',
                'nama_sertifikat' => 'Pelatihan Web Developer',
                'deskripsi' => 'backend',
                'sertifikat' => '',
                'penerbit' => 'PT Hummatech',
                'tgl_dikeluarkan' => Carbon::create('2000', '01', '01'),
            ]
        ]);
    }
}
