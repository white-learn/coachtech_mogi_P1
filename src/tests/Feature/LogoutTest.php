<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutTest extends TestCase
{
	use RefreshDatabase;

	protected $seed = true;

	public function test_user_can_logout()
	{
		$user = User::create([
			'name' => 'テストユーザー',
			'email' => 'test@example.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password123'),
		]);

		$this->actingAs($user);

		$response = $this->post('/logout');

		$this->assertGuest();

		$response->assertRedirect('/');
	}
}