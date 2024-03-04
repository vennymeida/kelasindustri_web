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
                'persyaratan' => 'frontend',
                'deskripsi' => 'harus rajin , dan punya pengalaman s1',
                'min_persyaratan' => 'mengaji , SMA',
                'gaji' => '1000',
                'keahlian' => 'frontend',
                'tipe_pekerjaan' => 'slicing',
                'tgl_tutup' => Carbon::create('2018', '01', '01'),
                'lokasi' => 'malang raya',
                'kuota' => '4'
            ],
            [
                'perusahaan_id' => '1',
                'nama_loker' => 'PT Hummantech ',
                'persyaratan' => 'backend',
                'deskripsi' => 'harus rajin , backend',
                'min_persyaratan' => 'mengaji , SMA',
                'gaji' => '1000',
                'keahlian' => 'backend',
                'tipe_pekerjaan' => 'API, JSON, PHP',
                'tgl_tutup' => Carbon::create('2018', '01', '01'),
                'lokasi' => 'malang raya',
                'kuota' => '4'
            ],

        ]);
    }
}
