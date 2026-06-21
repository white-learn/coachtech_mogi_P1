<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemIndexTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_all_items_are_displayed()
	{
		$response = $this->get('/');

		$response->assertStatus(200);

		$response->assertSee('腕時計');
		$response->assertSee('HDD');
		$response->assertSee('玉ねぎ3束');
		$response->assertSee('革靴');
		$response->assertSee('ノートPC');
	}

    public function test_sold_label_is_displayed_for_purchased_item()
    {
        $user = User::find(2);

        $response = $this
            ->actingAs($user)
            ->get('/');

        $response->assertStatus(200);
        $response->assertSee('腕時計');

        $response->assertSee('Sold');
    }

	public function test_user_items_are_not_displayed()
	{
		$user = User::find(1);

		$response = $this
			->actingAs($user)
			->get('/');

		$response->assertDontSee('腕時計');
		$response->assertDontSee('HDD');
		$response->assertDontSee('玉ねぎ3束');
		$response->assertDontSee('革靴');
		$response->assertDontSee('ノートPC');
	}
}