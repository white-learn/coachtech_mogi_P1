@extends('layout.header')

@section('title', '商品詳細')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/item_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
    <main class="container">
        <div class="item-detail">
            <!-- 左：商品画像 -->
            <div class="item-image">
                <img src="{{ asset('storage/items/' . $item->item_photo) }}" alt="{{ $item->item_name }}">
            </div>

            <!-- 右：商品情報 -->
            <div class="item-info">
                <h2>{{ $item->item_name }}</h2>

                <p class="brand">
                    {{ $item->brand_name }}
                </p>

                <p class="price">
                    <span>¥</span>{{ number_format($item->value) }}<span>（税込）</span>
                </p>

                <div class="icons">
                    <form action="/like" method="POST" class="icon-form">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button type="submit" class="icon-btn">
                            <img src="{{ asset( $isLiked ? 'storage/icons/like_color.png' : 'storage/icons/like.png' ) }}" alt="いいね">
                            <span>{{ $item->likeUsers->count() }}</span>
                        </button>
                    </form>
                    <div class="icon-item">
                        <img src="{{ asset('storage/icons/comment.png') }}" alt="コメント">
                        <span>{{ $item->comments->count() }}</span>
                    </div>
                </div>

                <form action="/purchase/{{ $item->id }}"    method="GET">
                    <button type="submit" class="form-btn">
                        購入手続きへ
                    </button>
                </form>

                <h3>商品説明</h3>

                <div class="info_plain">
                    {{ $item->item_plain }}
                </div>

                <h3>商品の情報</h3>

                <div class="info_kind">
                    <h4>カテゴリー</h4>
                        @foreach ($item->categories as $category)

                        <span class="tag">
                            {{ $category->category }}
                        </span>

                    @endforeach
                </div>
                <div class="info_kind">
                    <h4>商品の状態</h4>
                    <span>{{ $item->condition->condition }}</span>
                </div>

                <h3 class="comment-title">
                    コメント ({{ $item->comments->count() }})
                </h3>

                @foreach ($item->comments as $comment)
                    <div class="comment">
                        <div class="user_info">
                        @if ($comment->user->profile_photo)
                                <img src="{{ asset('storage/profiles/' . $comment->user->profile_photo) }}" alt="プロフィール画像" class="avatar">
                            @else
                                <div class="avatar"></div>
                            @endif

                                <div class="username">
                                    {{ $comment->user->name }}
                                </div>
                            </div>
                        <div class="comment-text">
                                {{ $comment->comment }}
                        </div>
                    </div>
                @endforeach

                <div class="comment-area">
                    <h4>商品へのコメント</h4>

                    @error('comment')
                        <p class="error">{{ $message }}</p>
                    @enderror

                    <form action="/comment" method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <textarea name="comment" class="comment-box"></textarea>
                        <button type="submit" class="form-btn">
                            コメントを送信する
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection