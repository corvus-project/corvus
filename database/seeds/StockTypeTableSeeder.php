<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StockTypeTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('stock_types');

        $groups = [
            [
                'name' => 'General Catalog',
                'slug' => 'GENERAL_CATALOG',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Available Stock',
                'slug' => 'Available_Stock',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pre-Order',
                'slug' => 'PRE_ORDER',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]                          
        ];

        DB::table('stock_types')->insert($groups);

        $this->enableForeignKeys();
    }
}