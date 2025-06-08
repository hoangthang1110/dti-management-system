<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage users',
            'manage roles',
            'configure indicators', // Quyền để quản lý danh mục và chỉ số DTI
            'enter dti data', // Quyền để nhập liệu dữ liệu DTI
            'view dti reports', // Quyền để xem báo cáo (sẽ làm sau)
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create roles and assign permissions
        $adminRole = Role::findOrCreate('admin');
        $managerRole = Role::findOrCreate('manager');
        $dataEntryClerkRole = Role::findOrCreate('data entry clerk');
        $viewerRole = Role::findOrCreate('viewer');


        // Admin has all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Manager permissions
        $managerRole->givePermissionTo([
            'configure indicators',
            'view dti reports',
            'enter dti data' // Manager cũng có thể nhập liệu
        ]);

        // Data Entry Clerk permissions
        $dataEntryClerkRole->givePermissionTo([
            'enter dti data',
            'view dti reports'
        ]);

        // Viewer permissions
        $viewerRole->givePermissionTo([
            'view dti reports'
        ]);

        // Assign roles to default users (optional, for testing)
        // Ensure you have users in your database, e.g., created in DatabaseSeeder
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Tìm hoặc tạo người dùng với email này
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Mật khẩu là 'password'
            ]
        )->assignRole('admin');

        User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('manager');

        User::firstOrCreate(
            ['email' => 'dataentry@example.com'],
            [
                'name' => 'Data Entry User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('data entry clerk');

        User::firstOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer User',
                'password' => bcrypt('password'),
            ]
        )->assignRole('viewer');
    }
}