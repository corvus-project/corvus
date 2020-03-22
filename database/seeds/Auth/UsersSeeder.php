<?php

use Database\traits\TruncateTable;
use Database\traits\DisableForeignKeys;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        $faker = Faker::create();
       
           
        $admin =   [
                    'name' => 'Admin',
                    'email' => 'admin@gazatem.com',
                    'password' => bcrypt('admin'),
                    'active' => true,
                    'confirmation_code' => \Ramsey\Uuid\Uuid::uuid4(),
                    'confirmed' => true,
                    'token' => null,
                    'email_verified_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
              
        DB::table('users')->insert($admin);

        $customer = [
                    'name' => 'Test Customer',
                    'email' => 'customer@gazatem.com',
                    'password' => bcrypt('customer'),
                    'active' => true,
                    'confirmation_code' => \Ramsey\Uuid\Uuid::uuid4(),
                    'confirmed' => true,
                    'token' => null,
                    'email_verified_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
        ];
        DB::table('users')->insert($customer);
            
        $users = [];
        for($i = 0; $i < 10; $i++){
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('user'),
                'active' => true,
                'confirmation_code' => \Ramsey\Uuid\Uuid::uuid4(),
                'confirmed' => true,
                'token' => null,
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);

        $this->enableForeignKeys();
    }
}