<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'user-management',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'pengajar-list',
            'pengajar-create',
            'pengajar-edit',
            'pengajar-delete',
            'mata-pelatihan-list',
            'mata-pelatihan-create',
            'mata-pelatihan-edit',
            'mata-pelatihan-delete',
            'pelatihan-list',
            'pelatihan-create',
            'pelatihan-edit',
            'pelatihan-delete',
            'surat-keputusan-list',
            'surat-keputusan-create',
            'surat-keputusan-edit',
            'surat-keputusan-delete',
            
        ];
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
