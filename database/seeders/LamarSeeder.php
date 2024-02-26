<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lamars')->insert([
            [
                'loker_id' => '1',
                'user_id' => '3',
                'resume' => '',
                'status' => 'pending',
            ],

        ]);
    }
}
