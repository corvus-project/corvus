<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('product_status');

        $groups = [
            [
                'name' => 'Active',
                'slug' => 'ACTIVE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],               
            [
                'name' => 'Delisted',
                'slug' => 'DELISTED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],    
            [
                'name' => 'Obsolete',
                'slug' => 'OBSOLETE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],                                                   
            [
                'name' => 'Inactive',
                'slug' => 'INACTIVE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]                       
        ];

        DB::table('product_status')->insert($groups);

        $this->enableForeignKeys();
    }
}