<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['view_product','add_product','update_product','delete_product','view_user','add_user','update_user','delete_user'];
        foreach ($permissions as $key => $permission) {
            Permission::create([
                'name'=>  $permission
             ]);
        }
    }
}
