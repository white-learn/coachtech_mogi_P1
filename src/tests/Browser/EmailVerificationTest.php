<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EmailVerificationTest extends DuskTestCase
{
	public function test_verification_email_is_sent_after_register()
	{
		$this->browse(function (Browser $browser) {
			$browser
				->visit('/register')
				->type('name', '認証テストユーザー')
				->type('email', 'verify@example.com')
				->type('password', 'password123')
				->type('password_confirmation', 'password123')
				->press('登録する')
				->visit('http://mailhog:8025')
				->assertSee('verify@example.com');
		});
	}

    public function test_authorization_button_opens_mailhog()
    {
        $user = User::firstOrCreate(
            [
                'email' => 'not_verified@example.com',
            ],
            [
                'name' => '未認証ユーザー',
                'password' => bcrypt('password123'),
                'email_verified_at' => null,
            ]
        );

        $this->browse(function (Browser $browser) use ($user) {

        $browser
            ->loginAs($user)
            ->visit('/authorization')
            ->assertSee('認証はこちらから')
            ->assertSourceHas('action="http://localhost:8025"');
        });
    }

    public function test_verified_user_can_access_profile_edit_page()
    {
        $user = User::where(
            'email',
            'verified@example.com'
            )->first();

        if (!$user) {
            $user = User::create([
                'name' => '認証済みユーザー',
                'email' => 'verified@example.com',
                'password' => bcrypt('password123'),
                'email_verified_at' => null,
            ]);
        }

        $user->markEmailAsVerified();

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit('/mypage/profile')
                ->assertPathIs('/mypage/profile');
            }
        );
    }
}