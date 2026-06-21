<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileEditTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_profile_values_are_displayed()
	{
		$user = User::find(1);

		$response = $this
			->actingAs($user)
			->get('/mypage/profile');

		$response->assertSee('テストユーザー');

		$response->assertSee('100-0001');

		$response->assertSee('千代田1-1-1');
	}
}