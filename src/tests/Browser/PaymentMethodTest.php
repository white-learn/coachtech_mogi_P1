<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PaymentMethodTest extends DuskTestCase
{

    public function test_payment_method_is_reflected()
	{
		$user = User::find(2);

		$this->browse(function (Browser $browser) use ($user) {

			$browser
				->loginAs($user)
				->visit('/purchase/8')

				->select(
					'payment_method',
					'convenience_store'
				)

				->pause(500)

				->assertSeeIn(
					'#payment_preview',
					'コンビニ払い'
				);

			$browser
				->select(
					'payment_method',
					'credit_card'
				)

				->pause(500)

				->assertSeeIn(
					'#payment_preview',
					'カード払い'
				);
		});
	}
}