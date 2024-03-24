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
                'pendidikan_id' => '1',
                'pengalaman_id' => '1',
                'pelatihan_id' => '1',
                'lamaran_id' => '1',
                'foto' => '',
                'jenis_kelamin' => 'laki-laki',
                'status' => 'aktif mencari kerja',
                'alamat' => 'jln griya',
                'no_hp' => '0852312412212',
                'resume' => '',
                'ringkasan' => 'saya adalah lulusan smk jurusan rekayasa perangkat lunak.
                saya memiliki keahlian dalam bidang pembuatan perangkat lunak khususnya website,
                saya memiliki pengalaman magang selama 6 bulan pada posisi frontend developer.
                Saya menguasai pengembangan website, framework laravel, html, css, javascript dan lain sebagainya.
                Saya mampu bekerja di dalam tim, bertanggung jawab.',
                'tgl_lahir' => Carbon::create('2017', '01', '01'),
            ],
            [
                'user_id' => '4',
                'pendidikan_id' => '2',
                'postingan_id' => '2',
                'portofolio_id' => '2',
                'pendidikan_id' => '2',
                'pengalaman_id' => '2',
                'pelatihan_id' => '2',
                'lamaran_id' => '2',
                'foto' => '',
                'jenis_kelamin' => 'perempuan',
                'status' => 'aktif mencari kerja',
                'alamat' => 'jln pesantren',
                'no_hp' => '0852312412213',
                'resume' => '',
                'ringkasan' => 'saya adalah lulusan smk jurusan game.
                saya memiliki keahlian dalam bidang pembuatan perangkat lunak khususnya website,
                dibagian backend developer,
                saya memiliki pengalaman magang selama 6 bulan pada posisi backend developer.
                Saya menguasai bahasa pemrograman laravel, mampu merancang api.
                Saya mampu mengelola basis data, mengelola api',
                'tgl_lahir' => Carbon::create('2017', '01', '01'),
            ],
        ]);
    }
}
