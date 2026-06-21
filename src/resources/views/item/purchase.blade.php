@extends('layout.header')

@section('title', '商品購入')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">

    <div class="purchase">

        <!-- 左側 -->
        <div class="left">

            <div class="item-info">

                <div class="image">
                    <img src="{{ asset('storage/items/' . $item->item_photo) }}" alt="{{ $item->item_name }}">
                </div>

                <div class="item-text">
                    <p class="name">
                        {{ $item->item_name }}
                    </p>

                    <p class="price">
                        <span>¥ </span>{{ number_format($item->value) }}
                    </p>
                </div>

            </div>

            <form action="/purchase/{{ $item->id }}" method="POST">
                @csrf

                <div class="section">

                    <label>支払い方法</label>

                    <select name="payment_method" id="payment_selected">
                        <option value="" disabled selected hidden>選択してください</option>
                        <option value="convenience_store">コンビニ払い</option>
                        <option value="credit_card">カード払い</option>
                    </select>
                    @error('payment_method')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

                <div class="section">
                    <input type="hidden" name="address" value="{{ $address->postal_code }} {{ $address->street_address }} {{ $address->building_name }}">

                    <div class="address-header">

                        <label>配送先</label>

                        <a href="/purchase/address/{{ $item->id }}" class="change">
                            変更する
                        </a>

                    </div>

                    <p>
                        〒{{ $address->postal_code }}
                    </p>

                    <p>
                        {{ $address->street_address }}
                    </p>

                    @if ($address->building_name)
                        <p>
                            {{ $address->building_name }}
                        </p>
                    @endif

                    @error('address')
                        <p class="error">{{ $message }}</p>
                    @enderror

                </div>

        </div>

        <!-- 右側 -->
        <div class="right">

            <div class="summary">

                <div class="summary-row">
                    <span>商品代金</span>

                        <div class="data-selected">
                            <span>¥ </span>{{ number_format($item->value) }}
                        </div>
                    </div>

                <div class="summary-row">
                    <span>支払い方法</span>

                <div class="data-selected" id="payment_preview">
                    未選択
                </div>
            </div>
        </div>

        <button type="submit" class="buy-btn">
            購入する
        </button>

            </form>

    </div>

</main>
@endsection

@section('js')
    <script src="{{ asset('js/payment_selected.js') }}"></script>
@endsection