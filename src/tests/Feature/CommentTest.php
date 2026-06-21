<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_logged_in_user_can_send_comment()
	{
		$user = User::find(2);
		$item = Item::find(8);

		$response = $this
			->actingAs($user)
			->post('/comment', [
				'item_id' => $item->id,
				'comment' => '購入を検討しています。',
			]);

		$response->assertRedirect();

		$this->assertDatabaseHas('comments', [
			'user_id' => $user->id,
			'item_id' => $item->id,
			'comment' => '購入を検討しています。',
		]);

		$response = $this->get('/item/' . $item->id);

		$response->assertSee('購入を検討しています。');
		$response->assertSee('1');
	}

	public function test_guest_cannot_send_comment()
	{
		$item = Item::find(8);

		$response = $this->post('/comment', [
			'item_id' => $item->id,
			'comment' => 'ログイン前のコメントです。',
		]);

		$this->assertDatabaseMissing('comments', [
			'item_id' => $item->id,
			'comment' => 'ログイン前のコメントです。',
		]);

		$response->assertRedirect('/login');
	}

	public function test_comment_is_required()
	{
		$user = User::find(2);
		$item = Item::find(8);

		$response = $this
			->actingAs($user)
			->post('/comment', [
				'item_id' => $item->id,
				'comment' => '',
			]);

		$response->assertSessionHasErrors([
			'comment' => 'コメントを入力してください',
		]);
	}

	public function test_comment_must_be_255_characters_or_less()
	{
		$user = User::find(2);
		$item = Item::find(8);

		$response = $this
			->actingAs($user)
			->post('/comment', [
				'item_id' => $item->id,
				'comment' => str_repeat('あ', 256),
			]);

		$response->assertSessionHasErrors([
			'comment' => 'コメントは255文字以内で入力してください',
		]);
	}
}