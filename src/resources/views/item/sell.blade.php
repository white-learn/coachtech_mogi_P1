@extends('layout.header')

@section('title', '商品出品')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common/error.css') }}">
@endsection

@section('content')
<main class="container">
	<h1>商品の出品</h1>

	<form action="/sell" method="POST" class="sell-form" enctype="multipart/form-data">
		@csrf

		<section class="section">
			<label>商品画像</label>

			<div class="image-upload-area">

				<img src="" class="item-image src-after-upload">

				<div class="image-upload area-after-upload">
					<input type="file" name="item_photo" id="item_photo" class="src-upload-btn" accept=".jpg,.jpeg,.png" hidden>

					<label for="item_photo" class="upload-btn">
						画像を選択する
					</label>
				</div>

			</div>
			@error('item_photo')
                <p class="error">{{ $message }}</p>
            @enderror

		</section>

		<section class="section">
			<h2>商品の詳細</h2>

			<label>カテゴリー</label>

			<div class="categories">
				@foreach($categories as $category)
				<label class="category-tag">
					<input type="checkbox" name="categories[]" value="{{ $category->id }}">
					<span>{{ $category->category }}</span>
				</label>
				@endforeach
			</div>
			@error('categories')
                <p class="error">{{ $message }}</p>
            @enderror

			<label>商品の状態</label>

			<select name="condition_id">
				<option value="">選択してください</option>

				@foreach($conditions as $condition)
				<option value="{{ $condition->id }}">
					{{ $condition->condition }}
				</option>
				@endforeach
			</select>
			@error('condition_id')
                <p class="error">{{ $message }}</p>
            @enderror
		</section>

		<section class="section">
			<h2>商品名と説明</h2>

			<label>商品名</label>
			<input type="text" name="item_name">
			@error('item_name')
                <p class="error">{{ $message }}</p>
            @enderror

			<label>ブランド名</label>
			<input type="text" name="brand_name">

			<label>商品の説明</label>
			<textarea name="item_plain"></textarea>
			@error('item_plain')
                <p class="error">{{ $message }}</p>
            @enderror

			<label>販売価格</label>
			@error('value')
                <p class="error">{{ $message }}</p>
            @enderror

			<div class="price">
				<span class="yen">¥</span>
				<input type="number" name="value">
			</div>
		</section>

		<button type="submit" class="submit-btn">
			出品する
		</button>
	</form>
</main>
@endsection

@section('js')
    <script src="{{ asset('js/image_after_upload.js') }}"></script>
@endsection