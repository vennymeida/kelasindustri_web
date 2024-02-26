<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('postingans')->insert([
            [
                'user_id' => '3',
                'media' => '',
                'konteks' => 'venny mau nyari kerja',
            ]
        ]);
    }
}
