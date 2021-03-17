<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon as Carbon;

class ProductTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('products');
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Faker\Provider\Barcode($faker));
        $status = \Corvus\Core\Models\ProductStatus::where('name', 'Active')->first();
        $products = [];

        for ($i = 1; $i < 500; $i++) {
            $products[] = [
                'name' => $faker->productName,
                'sku' => $faker->ean13,
                'status' => $status->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('products')->insert($products);

        $this->enableForeignKeys();
    }
}
