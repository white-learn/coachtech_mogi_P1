@extends('layout.header')

@section('title', 'プロフィール編集')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/common/form.css') }}">
	<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">

    <h1 class="title">プロフィール設定</h1>

	<form action="/mypage/profile" method="POST" class="form" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="avatar-section image-upload-area">
			@if ($user->profile_photo)
				<img src="{{ asset('storage/profiles/' . $user->profile_photo) }}" alt="プロフィール画像" class="avatar">
			@else
				<div class="avatar src-after-upload"></div>
			@endif

			<input type="file" name="profile_photo" id="profile_photo" hidden>
			<label for="profile_photo" class="upload-btn src-upload-btn">画像を選択する</label>
		</div>
		@error('profile_photo')
            <p class="error">{{ $message }}</p>
        @enderror

		<label>ユーザー名</label>
		<input type="text" name="name" value="{{ old('name', $user->name) }}">
		@error('name')
            <p class="error">{{ $message }}</p>
        @enderror

		<label>郵便番号</label>
		<input type="text" name="postal_code" value="{{ old('postal_code', optional($user->address)->postal_code) }}">
		@error('postal_code')
            <p class="error">{{ $message }}</p>
        @enderror

		<label>住所</label>
		<input type="text" name="street_address" value="{{ old('street_address', optional($user->address)->street_address) }}">
		@error('street_address')
            <p class="error">{{ $message }}</p>
        @enderror

		<label>建物名</label>
		<input type="text" name="building_name" value="{{ old('building_name', optional($user->address)->building_name) }}">

		<button type="submit" class="submit-btn">更新する</button>
	</form>

</main>
@endsection

@section('js')
    <script src="{{ asset('js/image_after_upload.js') }}"></script>
@endsection