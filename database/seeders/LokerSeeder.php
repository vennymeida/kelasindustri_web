<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lokers')->insert([
            [
                'perusahaan_id' => '1',
                'nama_loker' => 'PT Hummantech sejahtera',
                'persyaratan' => 'menguasai framework laravel, bisa slicing website, lulusan SMK jurusan rekayasa perangkat lunak',
                'deskripsi' => 'mengimplementasikan ui ke dalam frontend',
                'min_persyaratan' => 'mengaji , SMA',
                'gaji' => '1000',
                'keahlian' => 'html, css, javascript, framework laravel',
                'tipe_pekerjaan' => 'remote',
                'tgl_tutup' => Carbon::create('2018', '01', '01'),
                'lokasi' => 'malang raya',
                'kuota' => '4'
            ],
            [
                'perusahaan_id' => '1',
                'nama_loker' => 'PT Hummantech ',
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'mengelola basis data, mengelola api',
                'min_persyaratan' => 'mengaji , SMA',
                'gaji' => '1000',
                'keahlian' => 'laravel, mysql, api, ',
                'tipe_pekerjaan' => 'onsite',
                'tgl_tutup' => Carbon::create('2018', '01', '01'),
                'lokasi' => 'malang raya',
                'kuota' => '4'
            ],

        ]);
    }
}
