<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'user.management']);
        Permission::create(['name' => 'role.permission.management']);
        Permission::create(['name' => 'menu.management']);
        Permission::create(['name' => 'location.management']);
        Permission::create(['name' => 'menu.kategori']);
        Permission::create(['name' => 'menu.pekerjaan']);
        Permission::create(['name' => 'rekomendasi']);
        //user
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.import']);
        Permission::create(['name' => 'user.export']);

        //lulusan
        Permission::create(['name' => 'lulusan.index']);
        Permission::create(['name' => 'lulusan.create']);
        Permission::create(['name' => 'lulusan.edit']);
        Permission::create(['name' => 'lulusan.destroy']);
        Permission::create(['name' => 'lulusan.import']);
        Permission::create(['name' => 'lulusan.export']);

         //Perusahaan
         Permission::create(['name' => 'perusahaan.index']);
         Permission::create(['name' => 'perusahaan.create']);
         Permission::create(['name' => 'perusahaan.edit']);
         Permission::create(['name' => 'perusahaan.destroy']);
         Permission::create(['name' => 'perusahaan.import']);
         Permission::create(['name' => 'perusahaan.export']);

         //PostinganAdmin
        Permission::create(['name' => 'postinganadmin.index']);
        Permission::create(['name' => 'postinganadmin.destroy']);

        //role
        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.destroy']);
        Permission::create(['name' => 'role.import']);
        Permission::create(['name' => 'role.export']);

        //permission
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.destroy']);
        Permission::create(['name' => 'permission.import']);
        Permission::create(['name' => 'permission.export']);

        //assignpermission
        Permission::create(['name' => 'assign.index']);
        Permission::create(['name' => 'assign.create']);
        Permission::create(['name' => 'assign.edit']);
        Permission::create(['name' => 'assign.destroy']);

        //assingusertorole
        Permission::create(['name' => 'assign.user.index']);
        Permission::create(['name' => 'assign.user.create']);
        Permission::create(['name' => 'assign.user.edit']);

        //menu group
        Permission::create(['name' => 'menu-group.index']);
        Permission::create(['name' => 'menu-group.create']);
        Permission::create(['name' => 'menu-group.edit']);
        Permission::create(['name' => 'menu-group.destroy']);

        //menu item
        Permission::create(['name' => 'menu-item.index']);
        Permission::create(['name' => 'menu-item.create']);
        Permission::create(['name' => 'menu-item.edit']);
        Permission::create(['name' => 'menu-item.destroy']);

        //menu kota
        Permission::create(['name' => 'kota.index']);
        Permission::create(['name' => 'kota.create']);
        Permission::create(['name' => 'kota.edit']);
        Permission::create(['name' => 'kota.destroy']);

        //menu lowongan pekerjaan
        Permission::create(['name' => 'loker.index']);
        Permission::create(['name' => 'loker.create']);
        Permission::create(['name' => 'loker.edit']);
        Permission::create(['name' => 'loker.destroy']);

        //menu data pelamar kerja
        Permission::create(['name' => 'pelamarkerja.index']);
        Permission::create(['name' => 'pelamarkerja.create']);
        Permission::create(['name' => 'pelamarkerja.edit']);
        Permission::create(['name' => 'pelamarkerja.destroy']);

        //menu perhitungan rekomendasi
        Permission::create(['name' => 'rekomendasi.index']);
        Permission::create(['name' => 'rekomendasi.create']);
        Permission::create(['name' => 'rekomendasi.edit']);
        Permission::create(['name' => 'rekomendasi.destroy']);

        //loker-perusahaan
        Permission::create(['name' => 'loker-perusahaan.index']);
        Permission::create(['name' => 'loker-perusahaan.show']);
        Permission::create(['name' => 'loker-perusahaan.create']);
        Permission::create(['name' => 'loker-perusahaan.edit']);

        //lamar-perusahaan
        Permission::create(['name' => 'lamarperusahaan.index']);
        Permission::create(['name' => 'lamarperusahaan.show']);
        Permission::create(['name' => 'lamarperusahaan.edit']);

        //bookmarks
        Permission::create(['name' => 'bookmark.index']);

        //status-lamaran
        Permission::create(['name' => 'status-lamaran.index']);

        // create Super Admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        // create roles
        $roleLulusan = Role::create(['name' => 'lulusan']);
        $roleLulusan->givePermissionTo([
            'lulusan.index',
            'bookmark.index',
            'status-lamaran.index',
        ]);

        // create roles
        $rolePerusahaan = Role::create(['name' => 'perusahaan']);
        $rolePerusahaan->givePermissionTo(Permission::all());

        //assign user id 1 ke super admin
        $user = User::find(1);
        if ($user) {
            $user->assignRole('super-admin');
        }

        $user = User::find(2);
        if ($user) {
            $user->assignRole('perusahaan');
        }

        $user = User::find(3);
        if ($user) {
            $user->assignRole('lulusan');
        }
        $user = User::find(4);
        if ($user) {
            $user->assignRole('lulusan');
        }
    }
}
