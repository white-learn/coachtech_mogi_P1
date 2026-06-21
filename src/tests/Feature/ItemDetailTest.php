<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

		public function test_item_detail_displays_required_information()
		{
		$response = $this->get('/item/1');

		$response->assertStatus(200);

        $response->assertSee('腕時計');

        $response->assertSee('Rolax');

        $response->assertSee('15,000');

        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');

        $response->assertSee('商品の状態');

        $response->assertSee('カテゴリー');

        $response->assertSee('とてもかっこいい腕時計ですね！');

        $response->assertSee('サンプルユーザー');

        $response->assertSee('Armani+Mens+Clock.jpg');

        $response->assertSee('0');

        $response->assertSee('1');
}

	public function test_item_detail_displays_multiple_categories()
	{
		$response = $this->get('/item/1');

		$response->assertStatus(200);

		$response->assertSee('ファッション');
		$response->assertSee('メンズ');
	}
}