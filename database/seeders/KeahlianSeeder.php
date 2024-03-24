<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keahlians')->insert([
            [
                'user_id' => '3',
                'keahlian' => 'Web Designer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'Web Developer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'Backend Developer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'Frontend Developer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'Full Stack Developer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'Mobile App Developer',
            ],
            [
                'user_id' => '3',
                'keahlian' => 'PHP Developer',
            ],

        ]);
    }
}
