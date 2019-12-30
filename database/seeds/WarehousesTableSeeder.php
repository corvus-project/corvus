<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehousesTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('warehouses');

        $groups = [
            [
                'name' => 'Main Warehouse',
                'slug' => 'MAIN_WAREHOUSE',
                'description'   => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Burnley',
                'slug' => 'BURNLEY_WAREHOUSE',
                'description'   => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Boston Warehouse',
                'slug' => 'BOSTON_WAREHOUSE',
                'description'   => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],                        
                        
        ];

        DB::table('warehouses')->insert($groups);

        $this->enableForeignKeys();
    }
}