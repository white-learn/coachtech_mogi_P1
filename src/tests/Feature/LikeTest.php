<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_user_can_like_item()
	{
		$user = User::find(2);

		$item = Item::find(8);

		$this
			->actingAs($user)
			->post('/like', [
				'item_id' => $item->id,
			]);

		$this->assertDatabaseHas('like_items', [
			'user_id' => $user->id,
			'item_id' => $item->id,
		]);

		$response = $this->get('/item/' . $item->id);

		$response->assertSee('1');
	}

	public function test_liked_icon_is_displayed()
	{
		$user = User::find(2);

		$item = Item::find(8);

		$this
			->actingAs($user)
			->post('/like', [
				'item_id' => $item->id,
			]);

		$response = $this
			->actingAs($user)
			->get('/item/' . $item->id);

		$response->assertSee('like_color.png');
	}

	public function test_user_can_unlike_item()
	{
		$user = User::find(2);

		$item = Item::find(8);

		$this
			->actingAs($user)
			->post('/like', [
				'item_id' => $item->id,
			]);

		$this
			->actingAs($user)
			->post('/like', [
				'item_id' => $item->id,
			]);

		$this->assertDatabaseMissing('like_items', [
			'user_id' => $user->id,
			'item_id' => $item->id,
		]);

		$response = $this->get('/item/' . $item->id);

		$response->assertDontSee('like_color.png');
	}
}