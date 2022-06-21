<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrator']);
        $role2 = Role::create(['name' => 'Guest']);


        Permission::create([
            "name" => 'users/list'
        ])->assignRole($role1);

        Permission::create([
            "name" => 'users/get-users'
        ])->assignRole($role1);

        Permission::create([
            "name" => 'task/'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/list'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/get-quantity-task'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/find-task/{task}'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/update/{task}'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/delete/{task}'
        ])->syncRoles([$role1, $role2]);

        Permission::create([
            "name" => 'task/store'
        ])->syncRoles([$role1, $role2]);


    }
}
