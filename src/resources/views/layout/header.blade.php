<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    @yield('css')
</head>

<body>

    <header class="header">
        <div class="header-inner">
            <form action="/" method="GET" class="logo">
                <button type="submit" class="logo-btn">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="ロゴ">
                    <p>COΛCHTECH</p>
                </button>
            </form>

            @if(!request()->is(['login', 'register','email/verify']))
                <form action="/" method="GET">
                    <input type="text" name="keyword" class="search" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
                </form>

                <nav class="nav">
                    @guest
                        <form action="/login" method="GET">
                            <button type="submit">ログイン</button>
                        </form>
                    @endguest
                    @auth
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    @endauth
                    <form action="/mypage" method="GET">
                        <button  type="submit">マイページ</button>
                    </form>
                    <form action="/sell" method="GET">
                        <button type="submit" class="sell-btn">出品</button>
                    </form>
                </nav>
            @endif
        </div>
    </header>

    <div class="main">
        @yield('content')
    </div>

    @yield('js')
    
    </body>
</html>
