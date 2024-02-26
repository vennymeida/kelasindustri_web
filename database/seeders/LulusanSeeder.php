<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lulusans')->insert([
            [
                'user_id' => '3',
                'pendidikan_id' => '1',
                'postingan_id' => '1',
                'portofolio_id' => '1',
                'keahlian_id' => '1',
                'pendidikan_id' => '1',
                'pengalaman_id' => '1',
                'pelatihan_id' => '1',
                'lamaran_id' => '1',
                'foto' => '',
                'jenis_kelamin' => 'laki-laki',
                'status' => 'pending',
                'alamat' => 'jln griya',
                'no_hp' => '0852312412212',
                'resume' => '',
                'ringkasan' => '',
                'tgl_lahir' => Carbon::create('2017', '01', '01'),
            ],

        ]);
    }
}
