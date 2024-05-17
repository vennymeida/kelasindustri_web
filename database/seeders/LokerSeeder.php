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
                'perusahaan_id' => 1,
                'nama_loker' => 'Web Developer',
                'persyaratan' => 'menguasai framework laravel, bisa slicing website, lulusan SMK jurusan rekayasa perangkat lunak',
                'deskripsi' => 'mengimplementasikan ui ke dalam frontend',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'html, css, javascript, framework laravel',
                'lokasi' => 'Malang',
                'gaji_bawah' => '500000',
                'gaji_atas' => '100000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2025', '01', '01'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Backend Developer',
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'mengelola basis data, mengelola api',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'laravel, mysql, api',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '500000',
                'gaji_atas' => '100000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2025', '01', '01'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Backend Developer',
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'mengelola basis data, mengelola api',
                'tipe_pekerjaan' => 'Remote',
                'keahlian' => 'spatie',
                'lokasi' => 'Kediri',
                'gaji_bawah' => '1000000',
                'gaji_atas' => '5000000',
                'kuota' => 7,
                'tgl_tutup' => Carbon::create('2025', '01', '01'),
                'status' => 'Dibuka'
            ],


        ]);
    }
}
