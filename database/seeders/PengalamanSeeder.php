<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class PengalamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengalamans')->insert([
            [
                'user_id' => '3',
                'nama_pengalaman' => 'Magang Merdeka',
                'nama_instansi' => 'PT Hummatech Jaya',
                'alamat' => 'Jln Karangploso',
                'tipe' => 'Internship',
                'tgl_selesai' => Carbon::create('2000', '01', '01'),
                'tgl_mulai' => Carbon::create('2000', '01', '01'),
            ],
            [
                'user_id' => '3',
                'nama_pengalaman' => 'Praktek Kerja Lapangan',
                'nama_instansi' => 'PT Hummasoft',
                'alamat' => 'Surabaya',
                'tipe' => 'Internship',
                'tgl_selesai' => Carbon::create('2000', '01', '01'),
                'tgl_mulai' => Carbon::create('2000', '01', '01'),
            ],
        ]);
    }
}
