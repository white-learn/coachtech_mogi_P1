<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_profile_information_is_displayed()
	{
		$seller = User::find(1);

		$response = $this
			->actingAs($seller)
			->get('/mypage');

		$response->assertStatus(200);

		$response->assertSee('テストユーザー');

		$response->assertSee('user_1.png');

		$response->assertSee('腕時計');
		$response->assertSee('HDD');
		$response->assertSee('ノートPC');

		$buyer = User::find(2);

		$response = $this
			->actingAs($buyer)
			->get('/mypage?page=buy');

		$response->assertStatus(200);

		$response->assertSee('サンプルユーザー');

		$response->assertSee('user_2.png');

		$response->assertSee('腕時計');
		$response->assertSee('玉ねぎ3束');
		$response->assertSee('ノートPC');
	}
}