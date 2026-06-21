<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_changed_address_is_displayed()
	{
		$user = User::find(2);

		$this
			->actingAs($user)
			->put('/purchase/address/8', [
				'postal_code' => '111-1111',
				'street_address' => '東京都渋谷区',
				'building_name' => 'テストマンション',
			]);

		$response = $this
			->actingAs($user)
			->get('/purchase/8');

		$response->assertSee('111-1111');
		$response->assertSee('東京都渋谷区');
		$response->assertSee('テストマンション');
	}

	public function test_address_is_saved_to_buy_items()
	{
		$user = User::find(2);

		$this
			->actingAs($user)
			->put('/purchase/address/8', [
				'postal_code' => '111-1111',
				'street_address' => '東京都渋谷区',
				'building_name' => 'テストマンション',
			]);

		$this
			->actingAs($user)
			->get('/purchase/success/8');

		$this->assertDatabaseHas('buy_items', [
			'user_id' => 2,
			'item_id' => 8,
			'postal_code' => '111-1111',
			'street_address' => '東京都渋谷区',
			'building_name' => 'テストマンション',
		]);
	}
}