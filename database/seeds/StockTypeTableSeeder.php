<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StockGroupTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('stock_groups');

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
            ],
            [
                'name' => 'Out of Order',
                'slug' => 'OUT_OF_ORDER',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]                                        
        ];

        DB::table('stock_groups')->insert($groups);

        $this->enableForeignKeys();
    }
}