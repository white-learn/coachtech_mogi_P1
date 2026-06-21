<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_user_can_purchase_item()
	{
		$user = User::find(2);

		$response = $this
			->actingAs($user)
			->get('/purchase/success/8');

		$response->assertRedirect('/');

		$this->assertDatabaseHas('buy_items', [
			'user_id' => 2,
			'item_id' => 8,
		]);
	}

	public function test_purchased_item_is_displayed_as_sold()
	{
		$user = User::find(2);

		$this
			->actingAs($user)
			->get('/purchase/success/8');

		$response = $this->get('/');

		$response->assertSee('Sold');
	}

	public function test_purchased_item_is_displayed_in_profile()
	{
		$user = User::find(2);

		$this
			->actingAs($user)
			->get('/purchase/success/8');

		$response = $this
			->actingAs($user)
			->get('/mypage?page=buy');

		$response->assertSee('タンブラー');
	}
}