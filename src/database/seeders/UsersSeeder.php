<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
	public function run()
	{
		User::create([
			'name' => 'テストユーザー',
			'email' => 'hoge@hoge.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'profile_photo' => 'user_1.png',
		]);

		User::create([
			'name' => 'サンプルユーザー',
			'email' => 'sample@example.com',
			'email_verified_at' => now(),
			'password' => Hash::make('password'),
			'profile_photo' => 'user_2.png',
		]);
	}
}