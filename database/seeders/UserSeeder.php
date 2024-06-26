<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "perusahaan",
            'email' => "meidahersianty@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "lulusan",
            'email' => "lulusan@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Venny",
            'email' => "vennyhersi@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Andika Pratama, S.Kom",
            'email' => "getaplikasi@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "Adi Jaya Putra S.Tr.Kom",
            'email' => "acs@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => "abdhania",
            'email' => "smk8@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
