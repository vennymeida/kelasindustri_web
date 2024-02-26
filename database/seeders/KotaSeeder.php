<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kotas')->insert([
            ['name' => 'Surabaya'],
            ['name' => 'Malang'],
            ['name' => 'Batu'],
            ['name' => 'Nganjuk'],
            ['name' => 'Kediri'],
            ['name' => 'Madiun'],
        ]);
    }
}
