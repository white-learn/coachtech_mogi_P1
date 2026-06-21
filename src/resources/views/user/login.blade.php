@extends('layout.header')

@section('title', 'プロフィール編集')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">

    <h1 class="title">ログイン</h1>

    <!-- フォーム -->
    <form action="/login" method="POST" class="form">
        @csrf

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

        <button class="submit-btn">ログインする</button>
    </form>

    <form action="/register" method="GET" class="link-form">
        <button type="submit" class="link-btn">
            会員登録はこちら
        </button>
    </form>

</main>
@endsection