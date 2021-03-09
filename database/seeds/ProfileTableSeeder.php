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
        $this->truncate('account_profiles');
        $faker = \Faker\Factory::create();

        $users = Corvus\Core\Models\User::where('email', '<>', 'admin@gazatem.com')->get();
            foreach($users as $user)
            {
                $user = \Corvus\Core\Models\User::whereEmail($user->email)->first();
                \Corvus\Core\Models\Profile::create([
                                'user_id' => $user->id,
                                'stock_group_id' => $faker->numberBetween(1,3),
                                'pricing_group_id' => $faker->numberBetween(1,3),
                                'warehouse_id' => $faker->numberBetween(1,3),
                                'account_number' => $faker->regexify('[A-Za-z0-9]{20}') . $faker->numberBetween(5000,9900),
                                'account_group' => $faker->regexify('[A-Za-z0-9]{20}'),
                                ]);
            }





        $this->enableForeignKeys();
    }
}
