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
                'tingkatan' => 'SMK',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'nama_institusi' => 'SMKN 2 Kediri',
                'tahun_mulai' => '2017',
                'tahun_selesai' => '2020',
            ],
            [
                'user_id' => '4',
                'tingkatan' => 'SMK',
                'jurusan' => 'Game',
                'nama_institusi' => 'SMKN 3 Kediri',
                'tahun_mulai' => '2020',
                'tahun_selesai' => '2023',
            ]
        ]);
    }
}
