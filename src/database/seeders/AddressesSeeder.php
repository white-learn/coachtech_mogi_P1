<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
	public function run()
	{
		Address::create([
			'user_id' => 1,
			'postal_code' => '100-0001',
			'street_address' => '千代田1-1-1',
			'building_name' => 'テストビル101',
		]);

		Address::create([
			'user_id' => 2,
			'postal_code' => '150-0001',
			'street_address' => '渋谷1-2-3',
			'building_name' => 'サンプルマンション202',
		]);
	}
}