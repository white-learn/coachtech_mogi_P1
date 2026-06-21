@extends('layout.header')

@section('title', 'メール認証')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<main class="container">

    <div class="form">

        <p class="message">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </p>

        <form action="http://localhost:8025" method="GET" target="_blank">
            <button type="submit" class="submit-btn">
                認証はこちらから
            </button>
        </form>

        <form action="/email/verification-notification" method="POST" class="link-form">
            @csrf
            <button type="submit" class="link-btn">
                認証メールを再送する
            </button>
        </form>

    </div>

</main>
@endsection