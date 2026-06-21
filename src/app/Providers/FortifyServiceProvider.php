<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use App\Http\Responses\VerifyEmailResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Http\Responses\RegisterResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            VerifyEmailResponseContract::class,
            VerifyEmailResponse::class
        );

        $this->app->singleton(
            LoginResponseContract::class,
            LoginResponse::class
        );

        $this->app->singleton(
            RegisterResponseContract::class,
            RegisterResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
	public function boot(): void
	{
		Fortify::createUsersUsing(CreateNewUser::class);
		Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
		Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
		Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

		Fortify::registerView(function () {
			return view('user.register');
		});

		Fortify::loginView(function () {
			return view('user.login');
		});

		Fortify::verifyEmailView(function () {
			return view('user.authorization');
		});

		Fortify::authenticateUsing(function ($request) {

			validator(
				$request->all(),
				(new LoginRequest)->rules(),
				(new LoginRequest)->messages()
			)->validate();

			if (Auth::attempt([
				'email' => $request->email,
				'password' => $request->password,
			])) {

				return Auth::user();
			}

			throw ValidationException::withMessages([
				'email' => 'ログイン情報が登録されていません',
			]);
		});

		RateLimiter::for('login', function (Request $request) {
			$throttleKey = Str::transliterate(
				Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
			);

			return Limit::perMinute(5)->by($throttleKey);
		});

		RateLimiter::for('two-factor', function (Request $request) {
			return Limit::perMinute(5)->by(
				$request->session()->get('login.id')
			);
		});
	}
}