<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
	public function run()
	{
		DB::table('comments')->insert([

			[
				'user_id' => 2,
				'item_id' => 1,
				'comment' => 'とてもかっこいい腕時計ですね！',
				'created_at' => now(),
				'updated_at' => now(),
			],

			[
				'user_id' => 2,
				'item_id' => 2,
				'comment' => '使用期間はどのくらいですか？',
				'created_at' => now(),
				'updated_at' => now(),
			],

			[
				'user_id' => 2,
				'item_id' => 3,
				'comment' => 'まだ購入可能ですか？',
				'created_at' => now(),
				'updated_at' => now(),
			],

			[
				'user_id' => 2,
				'item_id' => 5,
				'comment' => 'バッテリーの状態を教えてください。',
				'created_at' => now(),
				'updated_at' => now(),
			],

			[
				'user_id' => 2,
				'item_id' => 7,
				'comment' => 'サイズ感はどのくらいでしょうか？',
				'created_at' => now(),
				'updated_at' => now(),
			],

			[
				'user_id' => 2,
				'item_id' => 9,
				'comment' => 'コーヒー好きなので気になります。',
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}