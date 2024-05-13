<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.p
     *
     * @return void
     */
    public function run()
    {




        $user = User::create([
            'title'                 =>'Miss.',
            'name'                  => 'superadmin',        
            'email'                 => 'superadmin@mail.com',
            'status'                =>1,
            'password' => Hash::make('superadmin')
        ]);
        $role = Role::find(1);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


    }
}

