<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kota;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kota::create([
            'kota' => "Malang",
        ]);
        Kota::create([
            'kota' => "Kediri",
        ]);
        Kota::create([
            'kota' => "Blitar",
        ]);
        Kota::create([
            'kota' => "Tulungagung",
        ]);
        Kota::create([
            'kota' => "Nganjuk",
        ]);
    }
}
