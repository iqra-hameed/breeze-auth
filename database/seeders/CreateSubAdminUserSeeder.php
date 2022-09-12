<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateSubAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'SubAdmin',
            'email' => 'subadmin@admin.com',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'SubAdmin']);
        $permissions = Permission::create(['name' => 'employee-create']);

       // $permissions = Permission::pluck('id','id')->givePermissionTo(['employee-create']);

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
