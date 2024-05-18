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
                'nama_loker' => 'Wordpress Front End Developer',
                'persyaratan' => 'menguasai framework laravel, bisa slicing website, lulusan SMK jurusan rekayasa perangkat lunak',
                'deskripsi' => 'mengimplementasikan ui ke dalam frontend',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'CMS, WordPress Development, Web Development',
                'lokasi' => 'Malang',
                'gaji_bawah' => '3.400.000',
                'gaji_atas' => '3.700.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '08', '24'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Web Developer',
                'persyaratan' => 'menguasai bahasa pemrograman laravel, mampu merancang api',
                'deskripsi' => 'Pengalaman Kurang dari 1 tahun dan minimal SMA/SMK',
                'tipe_pekerjaan' => 'Onsite',
                'keahlian' => 'laravel, mysql, api',
                'lokasi' => 'Surabaya',
                'gaji_bawah' => '3.900.000',
                'gaji_atas' => '4.000.000',
                'kuota' => 5,
                'tgl_tutup' => Carbon::create('2024', '08', '10'),
                'status' => 'Dibuka'
            ],
            [
                'perusahaan_id' => 1,
                'nama_loker' => 'Web Admin',
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
