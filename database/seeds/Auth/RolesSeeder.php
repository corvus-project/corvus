<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('roles');

        $roles = [
            [
                'name'       => 'administrator',
                'display_name'  => 'Administrator',
                'all'        => true,
                'sort'       => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'vendor',
                'display_name'  => 'Vendor',
                'all'        => false,
                'sort'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'supplier',
                'display_name'  => 'Supplier',
                'all'        => false,
                'sort'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'manufacturer',
                'display_name'  => 'Manufacturer',
                'all'        => false,
                'sort'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'orders_staff',
                'display_name'  => 'Orders Staff',
                'all'        => false,
                'sort'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'inventory_staff',
                'display_name'  => 'Inventory Staff',
                'all'        => false,
                'sort'       => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

         

        ];

        DB::table('roles')->insert($roles);

        $this->enableForeignKeys();
    }
}