<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PricingGroupTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('pricing_groups');

        $groups = [
            [
                'name' => 'General Catalog',
                'slug' => 'GENERAL_CATALOG',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Limited Edt.',
                'slug' => 'LIMITED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Out of Order',
                'slug' => 'OUT_ORDER',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Back Order',
                'slug' => 'BACK_ORDER',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]                          
        ];

        DB::table('pricing_groups')->insert($groups);

        $this->enableForeignKeys();
    }
}