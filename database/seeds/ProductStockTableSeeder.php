<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class ProductStockTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('stocks');
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Faker\Provider\Barcode($faker));

        $products = [];

        for ($i = 1; $i < 500; $i++) {
            $stocks[] = [
                'product_id' => $i,
                'stock_group_id' => $faker->numberBetween(1,4),
                'warehouse_id' => $faker->numberBetween(1,3),
                'quantity'    => $faker->numberBetween(0, 500),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                
            ];
                         
        }

        DB::table('stocks')->insert($stocks);

        $this->enableForeignKeys();
    }
}
