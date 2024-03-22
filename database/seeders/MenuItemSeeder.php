<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // MenuItem::factory()->count(10)->create();
        MenuItem::insert(
            [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'permission_name' => 'dashboard',
                    'menu_group_id' => 1,
                ],
                [
                    'name' => 'User List',
                    'route' => 'user-management/user',
                    'permission_name' => 'user.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Lulusan List',
                    'route' => 'user-management/lulusan',
                    'permission_name' => 'lulusan.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Perusahaan List',
                    'route' => 'user-management/perusahaan',
                    'permission_name' => 'perusahaan.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Postingan List',
                    'route' => 'user-management/postinganadmin',
                    'permission_name' => 'postinganadmin.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Permission List',
                    'route' => 'role-and-permission/permission',
                    'permission_name' => 'permission.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Permission To Role',
                    'route' => 'role-and-permission/assign',
                    'permission_name' => 'assign.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => 3,
                ],
                [
                    'name' => 'Menu Group',
                    'route' => 'menu-management/menu-group',
                    'permission_name' => 'menu-group.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Menu Item',
                    'route' => 'menu-management/menu-item',
                    'permission_name' => 'menu-item.index',
                    'menu_group_id' => 4,
                ],
                [
                    'name' => 'Keahlian Kerja',
                    'route' => 'menu-pekerjaan/keahlian',
                    'permission_name' => 'keahlian.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Lowongan Pekerjaan',
                    'route' => 'menu-pekerjaan/loker',
                    'permission_name' => 'loker.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Data Pelamar Kerja',
                    'route' => 'menu-pekerjaan/pelamarkerja',
                    'permission_name' => 'pelamarkerja.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Kota',
                    'route' => 'location-management/kota',
                    'permission_name' => 'kota.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Hasil TF - IDF',
                    'route' => 'rekomendasi-management/tf-idf',
                    'permission_name' => 'rekomendasi.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Hasil Cosine Similarity',
                    'route' => 'rekomendasi-management/cosine',
                    'permission_name' => 'rekomendasi.index',
                    'menu_group_id' => 7,
                ]
            ]
        );
    }
}
