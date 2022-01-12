<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating users and assigning roles to users
        $admin = User::create(['first_name'=>'Saad','last_name'=>'Farooq', 'email'=>'saad96farooq@gmail.com','image'=>'user.jpg','password'=>Hash::make('Saad12345')]);
        $admin->assignRole('Admin');
        // $admin->givePermissionTo('view_product');
        

        $staff = User::create(['first_name'=>'Bilal','last_name'=>'Hameed', 'email'=>'bilalhameed@gmail.com','image'=>'user.jpg','password'=>Hash::make('Saad12345')]);
        $staff->assignRole('Staff');

        $user = User::create(['first_name'=>'Umair','last_name'=>'Zafar', 'email'=>'umairzafar@gmail.com','image'=>'user.jpg','password'=>Hash::make('Saad12345')]);
        $user->assignRole('User');
    }
}
