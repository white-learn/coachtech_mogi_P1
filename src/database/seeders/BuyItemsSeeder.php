<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuyItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('buy_items')->insert([
            [
                'item_id' => 1,
                'user_id' => 2,
                'postal_code' => '123-4567',
                'street_address' => '東京都渋谷区1-1-1',
                'building_name' => 'サンプルマンション101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 3,
                'user_id' => 2,
                'postal_code' => '234-5678',
                'street_address' => '東京都新宿区2-2-2',
                'building_name' => 'サンプルマンション202',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'item_id' => 5,
                'user_id' => 2,
                'postal_code' => '345-6789',
                'street_address' => '東京都港区3-3-3',
                'building_name' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}