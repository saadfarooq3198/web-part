<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
           'name'=>'Admin'
        ]);

        // Assigning Permissions
        $adminPermissions = Permission::all();
        $admin->syncPermissions($adminPermissions);

        $staff = Role::create([
            'name'=>'Staff'
         ]);

        $staffPermissions = Permission::where('name','=',"view_user")->orwhere('name','=',"view_product")->get();
        $staff->syncPermissions($staffPermissions);

         $user = Role::create([
            'name'=>'User'
         ]);
         $userPermissions = Permission::where('name','=',"view_product")->get();
         $user->syncPermissions($userPermissions);
    }
}