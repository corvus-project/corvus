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
        $faker->addProvider(new Faker\Provider\DateTime($faker));

        
        $products = [];

        for ($i = 1; $i < 500; $i++) {

            $dt = $faker->dateTimeBetween('-300 days',  'now');
            $from_date = $dt->format("Y-m-d");
            $to_date = $dt->modify('+15 day')->format("Y-m-d");

            $stocks[] = [
                'product_id' => $i,
                'stock_type_id' => $faker->numberBetween(1,5),
                'warehouse_id' => $faker->numberBetween(1,3),
                'quantity'    => $faker->numberBetween(0, 500),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                
            ];
                         
        }

        DB::table('stocks')->insert($stocks);

        $this->enableForeignKeys();
    }
}
