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
                'deskripsi' => 'frontend',
                'nama_sertifikat' => 'HUMANTECH',
                'sertifikat' => 'PT hymmma',
                'penerbit' => Carbon::create('2000', '01', '01'),
                'tgl_dikeluarkan' => Carbon::create('2000', '01', '01'),
            ],
            [
                'user_id' => '3',
                'deskripsi' => 'backend',
                'nama_sertifikat' => 'HUMANTECH SOFT',
                'sertifikat' => 'Pt uwsa',
                'penerbit' => Carbon::create('2000', '01', '01'),
                'tgl_dikeluarkan' => Carbon::create('2000', '01', '01'),
            ]
        ]);
    }
}
