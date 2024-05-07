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
        Kota::create([
            'kota' => "Surabaya",
        ]);
        Kota::create([
            'kota' => "Banyuwangi",
        ]);
        Kota::create([
            'kota' => "Yogyakarta",
        ]);
        Kota::create([
            'kota' => "Solo",
        ]);
        Kota::create([
            'kota' => "Semarang",
        ]);
        Kota::create([
            'kota' => "Mojokerto",
        ]);
        Kota::create([
            'kota' => "Pamekasan",
        ]);
        Kota::create([
            'kota' => "Pacitan",
        ]);
        Kota::create([
            'kota' => "Lumajang",
        ]);
        Kota::create([
            'kota' => "Trenggalek",
        ]);
        Kota::create([
            'kota' => "Jakarta",
        ]);
        Kota::create([
            'kota' => "Bandung",
        ]);
    }
}
