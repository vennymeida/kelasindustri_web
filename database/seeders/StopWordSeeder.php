<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopWordSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stop_word')->insert([
            [
                'text' => '3',
            ],
            ['text' => 'adalah',],
            ['text' => 'saya',],
            ['text' => 'dalam',],
            ['text' => 'memiliki',],
            ['text' => 'biasa',],
            ['text' => 'menguasai',],
            ['text' => 'mampu',],
            ['text' => 'di',],
            ['text' => 'lulusan',],
            ['text' => 'pengalaman',],
            ['text' => 'keterampilan',],
            ['text' => 'dan',],
            ['text' => 'selama',],
            ['text' => 'aku',],
            ['text' => 'bulan',],
            ['text' => 'lain',],
            ['text' => 'sebagainya',],
            ['text' => 'jurusan',],
            ['text' => 'keahlian',],
            ['text' => 'bidang',],
            ['text' => 'pembuatan',],
            ['text' => 'khususnya',],
            ['text' => 'magang',],
            ['text' => 'pada',],
            ['text' => 'posisi',],
            ['text' => '6',],
            ['text' => 'bisa',],
            ['text' => 'ke',]
        ]);
    }
}
