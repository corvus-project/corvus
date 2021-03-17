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
            $dt = $faker->dateTimeBetween('-1 days',  'now');
            $from_date = Carbon::now();
            $to_date = $dt->modify('+15 day')->format("Y-m-d");

            $prices[] = [
                'product_id' => $i,
                'pricing_group_id' => 1,
                'price'    => $faker->randomFloat(2, $min = 0, $max = 500),
                'from_date' => $from_date,
                'to_date' => $to_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $from_date = $dt->modify('+1 day')->format("Y-m-d");
            $to_date = $dt->modify('+25 day')->format("Y-m-d");

            $prices[] = [
                'product_id' => $i,
                'pricing_group_id' => $faker->numberBetween(2,4),
                'price'    => $faker->randomFloat(2, $min = 0, $max = 500),
                'from_date' => Carbon::yesterday(),
                'to_date' => $to_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('pricings')->insert($prices);

        $this->enableForeignKeys();
    }
}
