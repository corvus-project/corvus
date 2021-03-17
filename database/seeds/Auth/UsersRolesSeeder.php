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

        $user = \Corvus\Core\Models\User::whereEmail('admin@gazatem.com')->first();
        $role = \Corvus\Core\Models\Role::where('name', 'administrator')->first();
        $user->attachRole($role);

        $user = \Corvus\Core\Models\User::whereEmail('orders_staff@gazatem.com')->first();
        $role = \Corvus\Core\Models\Role::where('name', 'orders_staff')->first();
        $user->attachRole($role);

        $user = \Corvus\Core\Models\User::whereEmail('inventory_staff@gazatem.com')->first();
        $role = \Corvus\Core\Models\Role::where('name', 'inventory_staff')->first();
        $user->attachRole($role);

        $role = \Corvus\Core\Models\Role::where('name', 'vendor')->first();

        $users = \Corvus\Core\Models\User::whereNotIn('email', ['admin@gazatem.com', 'orders_staff@gazatem.com', 'inventory_staff@gazatem.com'])->get();
        foreach ($users as $user) {
            $user = \Corvus\Core\Models\User::whereEmail($user->email)->first();
            if (!$user) continue;
            $user->attachRole($role);
        }

        $this->enableForeignKeys();
    }
}
