<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeItemsSeeder extends Seeder
{
	public function run()
	{
		DB::table('like_items')->insert([
			[
				'item_id' => 2,
				'user_id' => 2,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'item_id' => 4,
				'user_id' => 2,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'item_id' => 5,
				'user_id' => 2,
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}