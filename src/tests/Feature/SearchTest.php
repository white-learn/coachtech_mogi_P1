<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_user_can_search_items_by_partial_name()
	{
		$response = $this->get('/?keyword=PC');

		$response->assertStatus(200);

		$response->assertSee('ノートPC');

		$response->assertDontSee('腕時計');
	}

	public function test_search_keyword_is_kept_on_my_list_page()
	{
		$user = User::find(2);

		$response = $this
			->actingAs($user)
			->get('/?tab=myList&keyword=革');

		$response->assertStatus(200);

		$response->assertSee('value="革"', false);
	}
}