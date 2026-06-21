@extends('layout.header')

@section('title', 'プロフィール')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common/item_show.css') }}">
@endsection

@section('content')
<main class="container">

	<div class="profile-header">

		@if ($user->profile_photo)
			<img src="{{ asset('storage/profiles/' . $user->profile_photo) }}" alt="プロフィール画像" class="avatar">
		@else
			<div class="avatar"></div>
		@endif

		<div class="user-info">
			<h2>{{ $user->name }}</h2>
		</div>

		<form action="/mypage/profile" method="GET">
			<button type="submit" class="edit-btn">プロフィールを編集</button>
		</form>

	</div>

	<div class="tabs">

		<form action="/mypage" method="GET">
			<input type="hidden" name="page" value="sell">
			<button type="submit" class="{{ request('page') !== 'buy' ? 'active' : '' }}">
				出品した商品
			</button>
		</form>

		<form action="/mypage" method="GET">
			<input type="hidden" name="page" value="buy">
			<button type="submit" class="{{ request('page') === 'buy' ? 'active' : '' }}">
				購入した商品
			</button>
		</form>

	</div>

	<div class="item-grid">

		@foreach ($items as $item)

			<div class="item">

				<a href="/item/{{ $item->id }}">

					<div class="item-image">
						<img src="{{ asset('storage/items/' . $item->item_photo) }}" alt="{{ $item->item_name }}">
					</div>

					<p class="item-name">
						{{ $item->item_name }}
					</p>

				</a>

			</div>

		@endforeach

	</div>

</main>
@endsection