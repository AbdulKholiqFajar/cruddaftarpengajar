<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        
        $adminRole = Role::create(['name' => 'admin']);
        
        $permissions = Permission::pluck('id', 'id')->all();
        $adminRole->syncPermissions($permissions);
        
        $adminUser->assignRole([$adminRole->id]);
        
        // Create user role
        $userRole = Role::create(['name' => 'petugas_satker']);
        $userUser = User::create([
            'name' => 'Abdul Kholiq Fajar',
            'email' => 'abdul@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        $userUser->assignRole([$userRole->id]);
        
        // Create guest role
        $guestRole = Role::create(['name' => 'penyelengara']);
        $guestUser = User::create([
            'name' => 'Fajar Abdul Kholiq',
            'email' => 'fajar@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        $guestUser->assignRole([$guestRole->id]);
    }
}
