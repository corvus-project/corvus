<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('order_status');

        $groups = [
            [
                'name' => 'New Order',
                'slug' => 'NEW_ORDER',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],               
            [
                'name' => 'Processing',
                'slug' => 'PROCESSING',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],    
            [
                'name' => 'Approved',
                'slug' => 'APPROVED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],                                                   
            [
                'name' => 'Denied',
                'slug' => 'DENIED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],                
            [
                'name' => 'Canceled',
                'slug' => 'CANCELED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],     
            [
                'name' => 'Not Found',
                'slug' => 'NOT_FOUND',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],  
            [
                'name' => 'Failed',
                'slug' => 'FAILED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],                             
        ];

        DB::table('order_status')->insert($groups);

        $this->enableForeignKeys();
    }
}