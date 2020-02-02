<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('role_user');

        $user = \App\Models\User::whereEmail('admin@gazatem.com')->first();
        $role = \App\Models\Role::where('name', 'administrator')->first();
        $user->attachRole($role);
        $role = \App\Models\Role::where('name', 'customer')->first();

        $users = \App\Models\User::where('email', '!=' ,'admin@gazatem.com')->get();
        foreach ($users as $user) {
            
            $user = \App\Models\User::whereEmail($user->email)->first();

            if (!$user) continue;
            $user->attachRole($role);
        } 
 
        $this->enableForeignKeys();
    }
}