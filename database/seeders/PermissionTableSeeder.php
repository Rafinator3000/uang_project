<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'lokasi_uang-list',
            'lokasi_uang-create',
            'lokasi_uang-edit',
            'lokasi_uang-delete',
            'uang_masuk-list',
            'uang_masuk-create',
            'uang_masuk-edit',
            'uang_masuk-delete',
            'uang_keluar-list',
            'uang_keluar-create',
            'uang_keluar-edit',
            'uang_keluar-delete',
            'uang-masuk-pdf',
            'uang-keluar-pdf'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
