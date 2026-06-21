<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;

class ItemController extends Controller
{
    /**
     * 商品一覧
     */
	public function index(Request $request)
	{
		$keyword = $request->keyword;

		if ($request->tab === 'myList') {

			if (!Auth::check()) {

				$items = collect();

			} else {

				$items = Auth::user()
					->likeItems()
					->with('buyUsers');

				if (!empty($keyword)) {
					$items->where(
						'item_name',
						'like',
						"%{$keyword}%"
					);
				}

				$items = $items->get();
			}

			return view('item.top', compact('items'));
		}

		$items = Item::with('buyUsers');

		if (Auth::check()) {
			$items->where(
				'sell_user_id',
				'!=',
				Auth::id()
			);
		}

		if (!empty($keyword)) {
			$items->where(
				'item_name',
				'like',
				"%{$keyword}%"
			);
		}

		$items = $items->get();

		return view('item.top', compact('items'));
	}

    /**
     * 商品詳細
     */
    public function getItemInfo($item_id)
    {
        $item = Item::with([
            'categories',
            'condition',
            'comments.user',
            'likeUsers',
            ])->findOrFail($item_id);

        $isLiked = false;

        if (Auth::check()) {
            $isLiked = $item->likeUsers
                ->contains(Auth::id());
            }

        return view(
            'item.item_info',
            compact('item', 'isLiked')
        );
    }

    /**
     * 出品画面
     */
    public function showSell()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('item.sell', compact(
            'categories',
            'conditions'
        ));
    }

    /**
     * 商品出品
     */
    public function sell(ExhibitionRequest $request)
    {

        if ($request->hasFile('item_photo')) {
            $path = $request->file('item_photo')->store(
                'items',
                'public'
            );

            $path = basename($path);
        } else {

            $path = null;
        }

        $item = Item::create([
            'item_name' => $request->item_name,
            'item_photo' => $path,
            'value' => $request->value,
            'item_plain' => $request->item_plain,
            'brand_name' => $request->brand_name,
            'condition_id' => $request->condition_id,
            'sell_user_id' => Auth::id(),
        ]);

        if ($request->filled('categories')) {
            $item->categories()->attach(
                $request->categories
            );
        }

        return redirect('/');
    }

    /**
     * 購入画面
     */
    public function showPurchase($item_id)
    {
        $item = Item::findOrFail($item_id);

        $user = Auth::user();

        $address = $user->address;

        return view(
            'item.purchase',
            compact(
                'item',
                'address'
            )
        );
    }

    /**
     * 購入処理
     */
	public function purchase(PurchaseRequest $request)
	{
		$item = Item::findOrFail($request->item_id);

		$stripe = new StripeClient(
			config('services.stripe.secret')
		);

		if ($request->payment_method === 'convenience_store') {
			$paymentMethodTypes = ['konbini'];
		} else {
			$paymentMethodTypes = ['card'];
		}

		$session = $stripe->checkout->sessions->create([
			'payment_method_types' => $paymentMethodTypes,
			'line_items' => [[
				'price_data' => [
					'currency' => 'jpy',
					'product_data' => [
						'name' => $item->item_name,
					],
					'unit_amount' => $item->value,
				],
				'quantity' => 1,
			]],
			'mode' => 'payment',
			'success_url' => url('/purchase/success/' . $item->id),
			'cancel_url' => url('/purchase/' . $item->id),
		]);

		return redirect($session->url);
	}

    /**
     * Stripe成功後処理
     */
    public function purchaseSuccess($item_id)
    {
        $item = Item::findOrFail($item_id);

        $address = Auth::user()->address;

        $item->buyUsers()->syncWithoutDetaching([
            Auth::id() => [
                'postal_code' => $address->postal_code,
                'street_address' => $address->street_address,
                'building_name' => $address->building_name,
            ],
        ]);

        return redirect('/');
    }

    /**
     * いいね
     */
    public function toggleLike(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        if ($item->likeUsers()->where('user_id', Auth::id())->exists()) {

            $item->likeUsers()->detach(Auth::id());

        } else {

            $item->likeUsers()->attach(Auth::id());
        }

        return back();
    }

    /**
     * コメント投稿
     */
    public function storeComment(CommentRequest $request)
    {

        Comment::create([
            'item_id' => $request->item_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back();
    }
}