<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
	public function run()
	{
		Item::insert([

			[
				'item_name' => '腕時計',
				'item_photo' => 'Armani+Mens+Clock.jpg',
				'value' => 15000,
				'item_plain' => 'スタイリッシュなデザインのメンズ腕時計',
				'brand_name' => 'Rolax',
				'condition_id' => 1,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'HDD',
				'item_photo' => 'HDD+Hard+Disk.jpg',
				'value' => 5000,
				'item_plain' => '高速で信頼性の高いハードディスク',
				'brand_name' => '西芝',
				'condition_id' => 2,
				'sell_user_id' => 1,
			],

			[
				'item_name' => '玉ねぎ3束',
				'item_photo' => 'iLoveIMG+d.jpg',
				'value' => 300,
				'item_plain' => '新鮮な玉ねぎ3束のセット',
				'brand_name' => 'なし',
				'condition_id' => 3,
				'sell_user_id' => 1,
			],

			[
				'item_name' => '革靴',
				'item_photo' => 'Leather+Shoes+Product+Photo.jpg',
				'value' => 4000,
				'item_plain' => 'クラシックなデザインの革靴',
				'brand_name' => '',
				'condition_id' => 4,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'ノートPC',
				'item_photo' => 'Living+Room+Laptop.jpg',
				'value' => 45000,
				'item_plain' => '高性能なノートパソコン',
				'brand_name' => '',
				'condition_id' => 1,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'マイク',
				'item_photo' => 'Music+Mic+4632231.jpg',
				'value' => 8000,
				'item_plain' => '高音質のレコーディング用マイク',
				'brand_name' => 'なし',
				'condition_id' => 2,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'ショルダーバッグ',
				'item_photo' => 'Purse+fashion+pocket.jpg',
				'value' => 3500,
				'item_plain' => 'おしゃれなショルダーバッグ',
				'brand_name' => '',
				'condition_id' => 3,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'タンブラー',
				'item_photo' => 'Tumbler+souvenir.jpg',
				'value' => 500,
				'item_plain' => '使いやすいタンブラー',
				'brand_name' => 'なし',
				'condition_id' => 4,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'コーヒーミル',
				'item_photo' => 'Waitress+with+Coffee+Grinder.jpg',
				'value' => 4000,
				'item_plain' => '手動のコーヒーミル',
				'brand_name' => 'Starbacks',
				'condition_id' => 1,
				'sell_user_id' => 1,
			],

			[
				'item_name' => 'メイクセット',
				'item_photo' => '外出メイクアップセット.jpg',
				'value' => 2500,
				'item_plain' => '便利なメイクアップセット',
				'brand_name' => '',
				'condition_id' => 2,
				'sell_user_id' => 1,
			],
		]);
	}
}