<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Nectar Digit',
            'email' => 'nectardigit@gmail.com',
            'password' => Hash::make('Admin@123'),


        ]);

        $role = Role::create(['id' => '1', 'name' => 'Super Admin']);
        $permissions = Permission::pluck('id', 'id');
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
