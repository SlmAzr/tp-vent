<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Role::create(['name' => 'admin']);
        $organisator = Role::create(['name' => 'organisator']);
        $user = Role::create(['name' => 'user']);

        // Création des permissions
    
        Permission::create(['name'=>'manage_users']);

        Permission::create(['name'=>'create_event']);
        Permission::create(['name'=>'manage_event']);

        Permission::create(['name'=>'signIn_event']);
  


        $admin->givePermissionTo(['manage_users','create_event', 'manage_event', 'signIn_event']);
        $organisator->givePermissionTo('create_event', 'manage_event', 'signIn_event');
        $user->givePermissionTo('signIn_event');
    }
}
