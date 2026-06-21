<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellItemTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_user_can_sell_item()
	{
		Storage::fake('public');

		$user = User::find(1);

		$response = $this
			->actingAs($user)
			->post('/sell', [
				'item_photo' => UploadedFile::fake()->create(
                    'test_item.png',
                    100,
                    'image/png'
                ),
				'item_name' => 'テスト商品',
				'brand_name' => 'テストブランド',
				'item_plain' => '説明文',
				'value' => 1000,
				'condition_id' => 1,
				'categories' => [1, 2],
			]);

		$response->assertRedirect('/');

		$this->assertDatabaseHas('items', [
			'item_name' => 'テスト商品',
			'brand_name' => 'テストブランド',
			'item_plain' => '説明文',
			'value' => 1000,
			'condition_id' => 1,
			'sell_user_id' => 1,
		]);

		$this->assertDatabaseHas('item_categories', [
			'item_id' => \App\Models\Item::where(
				'item_name',
				'テスト商品'
			)->first()->id,
			'category_id' => 1,
		]);

		$this->assertDatabaseHas('item_categories', [
			'item_id' => \App\Models\Item::where(
				'item_name',
				'テスト商品'
			)->first()->id,
			'category_id' => 2,
		]);
	}
}