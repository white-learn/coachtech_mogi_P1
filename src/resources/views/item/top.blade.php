@extends('layout.header')

@section('title', 'プロフィール')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/common/item_show.css') }}">
@endsection

@section('content')
<main class="container">

    <!-- タブ -->
    <div class="tabs">
        <form action="/" method="GET">
            <button type="submit" class="{{ request('tab') !== 'myList' ? 'active' : '' }}">
                おすすめ
            </button>
        </form>

        <form action="/" method="GET">
            <input type="hidden" name="tab" value="myList">
            <button type="submit" class="{{ request('tab') === 'myList' ? 'active' : '' }}">
                マイリスト
            </button>
        </form>
    </div>

	<!-- 商品一覧 -->
	<div class="item-grid">
		@foreach ($items as $item)
			<div class="item">
				<a href="/item/{{ $item->id }}">
					<div class="item-image">

						<img src="{{ asset('storage/items/' . $item->item_photo) }}" alt="{{ $item->item_name }}">
					</div>

					<p class="item-name">
						{{ $item->item_name }}
                        @if ($item->buyUsers->contains(Auth::id()))
							<span>(Sold)</span>
						@endif
					</p>
				</a>
			</div>
		@endforeach
	</div>

</main>
@endsection