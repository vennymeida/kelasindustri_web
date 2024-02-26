<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendidikans')->insert([
            [
                'user_id' => '3',
                'tingkatan' => '3',
                'jurusan' => 'IPA',
                'nama_instutsi' => 'SMA 1 Nganjuk',
                'tahun_mulai' => Carbon::create('2017', '01', '01'),
                'tahun_selesai' => Carbon::create('2017', '01', '01'),
            ],
            [
                'user_id' => '3',
                'tingkatan' => '3',
                'jurusan' => 'BAHASA',
                'nama_instutsi' => 'SMA 1 Nganjuk',
                'tahun_mulai' => Carbon::create('2017', '01', '01'),
                'tahun_selesai' => Carbon::create('2017', '01', '01'),
            ],
        ]);
    }
}
