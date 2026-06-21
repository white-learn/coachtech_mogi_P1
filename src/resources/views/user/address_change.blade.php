@extends('layout.header')

@section('title', '住所変更')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">

    <h1 class="title">住所の変更</h1>

    <form action="/purchase/address/{{ $item_id }}" method="POST" class="form">
        @csrf
        @method('PUT')

        <label>郵便番号</label>
        <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}">
        @error('postal_code')
			<p class="error">{{ $message }}</p>
		@enderror

        <label>住所</label>
        <input type="text" name="street_address" value="{{ old('street_address', $address->street_address) }}">
        @error('street_address')
			<p class="error">{{ $message }}</p>
		@enderror

        <label>建物名</label>
        <input type="text" name="building_name" value="{{ old('building_name', $address->building_name) }}">

        <button type="submit" class="submit-btn">
            更新する
        </button>

    </form>

</main>
@endsection