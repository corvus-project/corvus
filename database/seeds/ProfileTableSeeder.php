<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class ProfileTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('stocks');
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Faker\Provider\Barcode($faker));
 
        $users = App\Models\User::where('email', '<>', 'admin@gazatem.com')->get();
            foreach($users as $user)
            {
                $user = \App\Models\User::whereEmail($user->email)->first();
                \App\Models\Profile::create([
                                'user_id' => $user->id,
                                'stock_type_id' => $faker->numberBetween(1,3), 
                                'pricing_group_id' => $faker->numberBetween(1,3),
                                'warehouse_id' => $faker->numberBetween(1,3),
                                ]);
            }
    


       

        $this->enableForeignKeys();
    }
}