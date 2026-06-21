<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyListTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_only_liked_items_are_displayed()
	{
		$user = User::find(2);

		$response = $this
			->actingAs($user)
			->get('/?tab=myList');

		$response->assertStatus(200);

		$response->assertSee('HDD');
		$response->assertSee('革靴');
		$response->assertSee('ノートPC');

		$response->assertDontSee('腕時計');
		$response->assertDontSee('玉ねぎ3束');
	}

	public function test_sold_label_is_displayed_for_purchased_item_in_my_list()
	{
		$user = User::find(2);

		$response = $this
			->actingAs($user)
			->get('/?tab=myList');

		$response->assertStatus(200);

		$response->assertSee('Sold');
	}

	public function test_my_list_is_empty_when_guest()
	{
		$response = $this->get('/?tab=myList');

		$response->assertStatus(200);

		$response->assertDontSee('腕時計');
		$response->assertDontSee('HDD');
		$response->assertDontSee('玉ねぎ3束');
		$response->assertDontSee('革靴');
		$response->assertDontSee('ノートPC');
		$response->assertDontSee('マイク');
	}
}