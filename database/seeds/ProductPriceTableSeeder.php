<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class ProductPriceTableSeeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('pricings');
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Faker\Provider\Barcode($faker));

        $products = [];

        for ($i = 1; $i < 500; $i++) {
            $prices[] = [
                'product_id' => $i,
                'pricing_group_id' => $faker->numberBetween(1,4),
                'amount'    => $faker->randomFloat(2, $min = 0, $max = 500),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                
            ];

            $prices[] = [
                'product_id' => $i,
                'pricing_group_id' => $faker->numberBetween(1,5),
                'amount'    => $faker->randomFloat(2, $min = 0, $max = 500),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                
            ];
        }

        DB::table('pricings')->insert($prices);

        $this->enableForeignKeys();
    }
}
