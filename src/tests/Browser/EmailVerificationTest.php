<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EmailVerificationTest extends DuskTestCase
{
    public function test_verification_email_is_sent_after_register()
    {
        $email = 'verify_' . uniqid() . '@example.com';

        $this->browse(function (Browser $browser) use ($email) {

            $browser
                ->visit('/register')
                ->type('name', '認証テストユーザー')
                ->type('email', $email)
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->press('登録する')
                ->pause(1000)
                ->assertPathIs('/authorization')
                ->visit('http://mailhog:8025')
                ->assertSee($email);

        });
    }

    public function test_authorization_button_opens_mailhog()
    {
        $email = 'not_verified_' . uniqid() . '@example.com';

        $user = User::create([
            'name' => '未認証ユーザー',
            'email' => $email,
            'password' => bcrypt('password123'),
            'email_verified_at' => null,
        ]);

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
        $email = 'verified_' . uniqid() . '@example.com';

        $user = User::create([
        'name' => '認証済みユーザー',
        'email' => $email,
        'password' => bcrypt('password123'),
        ]);

        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();

        $this->browse(function (Browser $browser) use ($user) {

            $browser
                ->loginAs($user)
                ->visit('/mypage/profile')
                ->assertPathIs('/mypage/profile');
        });
    }
}