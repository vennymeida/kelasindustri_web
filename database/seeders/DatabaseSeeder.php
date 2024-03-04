<?php

namespace Database\Seeders;

use App\Models\KategoriPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            MenuGroupSeeder::class,
            MenuItemSeeder::class,
            CategorySeeder::class,
            PostinganSeeder::class,
            PengalamanSeeder::class,
            PendidikanSeeder::class,
            KotaSeeder::class,
            KeahlianSeeder::class,
            PerusahaanSeeder::class,
            PortofolioSeeder::class,
            LokerSeeder::class,
            LamarSeeder::class,
            PelatihanSeeder::class,
            LulusanSeeder::class,
            KategoriPekerjaanSeeder::class,
        ]);
    }
}
