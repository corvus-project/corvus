<?php

use Database\traits\DisableForeignKeys;
use Database\traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon as Carbon;

class SettingsTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('settings');
        $settings = [
            [
                'name' => 'Currency',
                'setting_key' => 'currency',
                'setting_value' => 'GBP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Site Name',
                'setting_key' => 'app_name',
                'setting_value' => 'Corvus',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];
        DB::table('settings')->insert($settings);

        $this->enableForeignKeys();
    }
}
