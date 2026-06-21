<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

// 商品一覧画面表示
Route::get('/', [ItemController::class, 'index']);

// 商品詳細画面表示
Route::get('/item/{item_id}', [ItemController::class, 'getItemInfo']);

// メール認証誘導画面
Route::get('/authorization', function () {
    return view('user/authorization');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Auth Required
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 商品購入画面表示
    Route::get('/purchase/{item_id}', [ItemController::class, 'showPurchase']);

    // 商品購入処理
    Route::post('/purchase/{item_id}', [ItemController::class, 'purchase']);

    // Stripe処理
    Route::get('/purchase/success/{item_id}', [ItemController::class, 'purchaseSuccess']);

    // 住所変更画面表示
    Route::get('/purchase/address/{item_id}', [UserController::class, 'showAddressEdit']);

    // 住所変更処理
    Route::put('/purchase/address/{item_id}', [UserController::class, 'editAddress']);

    // 出品画面表示
    Route::get('/sell', [ItemController::class, 'showSell']);

    // 出品処理
    Route::post('/sell', [ItemController::class, 'sell']);

    // プロフィール
    Route::get('/mypage', [UserController::class, 'index']);

    // プロフィール編集画面表示
    Route::get('/mypage/profile', [UserController::class, 'showProfileEdit']);

    // プロフィール更新
    Route::put('/mypage/profile', [UserController::class, 'editProfile']);

    // いいね
    Route::post('/like', [ItemController::class, 'toggleLike']);

    // コメント投稿
    Route::post('/comment', [ItemController::class, 'storeComment']);
});