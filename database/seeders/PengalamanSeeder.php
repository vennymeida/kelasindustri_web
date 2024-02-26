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
                'tipe' => '2',
                'nama_pengalaman' => 'frontend',
                'nama_instasi' => 'HUMANTECH',
                'alamat' => 'jln kusima',
                'tingkatan' => '3',
                'tgl_selesai' => Carbon::create('2000', '01', '01'),
                'tgl_mulai' => Carbon::create('2000', '01', '01'),
            ],
            [
                'user_id' => '3',
                'tipe' => '2',
                'nama_pengalaman' => 'backend',
                'nama_instasi' => 'HUMANTECH',
                'alamat' => 'jln kusima',
                'tingkatan' => '3',
                'tgl_selesai' => Carbon::create('2000', '01', '01'),
                'tgl_mulai' => Carbon::create('2000', '01', '01'),
            ],
        ]);
    }
}
