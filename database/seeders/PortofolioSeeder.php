<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portofolios')->insert([
            [
                'user_id' => '3',
                'link_portofolio' => 'hahahha',
                'nama_portofolio' => 'frontend',
            ]
        ]);
    }
}
