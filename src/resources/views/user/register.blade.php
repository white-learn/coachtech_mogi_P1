@extends('layout.header')

@section('title', '会員登録')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">

    <h1 class="title">会員登録</h1>

    <!-- フォーム -->
	<form action="/register" method="POST" class="form">
		@csrf

		<label>ユーザー名</label>
		<input type="text" name="name" value="{{ old('name') }}">
		@error('name')
			<p class="error">{{ $message }}</p>
		@enderror

		<label>メールアドレス</label>
		<input type="email" name="email" value="{{ old('email') }}">
		@error('email')
			<p class="error">{{ $message }}</p>
		@enderror

		<label>パスワード</label>
		<input type="password" name="password">
		@error('password')
			<p class="error">{{ $message }}</p>
		@enderror

		<label>確認用パスワード</label>
		<input type="password" name="password_confirmation">

		<button type="submit" class="submit-btn">登録する</button>
    </form>

	<form action="/login" method="GET" class="link-form">
        <button type="submit" class="link-btn">
            ログインはこちら
        </button>
    </form>

</main>
@endsection