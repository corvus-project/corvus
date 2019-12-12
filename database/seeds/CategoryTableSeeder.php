<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon as Carbon;

class CategoryTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('categories');
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

        $categories = [];

        for ($i = 1; $i < 50; $i++) {
            $categories[] = [
                'name' => $faker->department,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),                
            ];
        }

        DB::table('categories')->insert($categories);

        $this->enableForeignKeys();
    }
}
