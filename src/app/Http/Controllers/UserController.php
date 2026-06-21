<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    /**
     * プロフィール画面
     * /mypage
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->page === 'buy') {
            $items = $user->buyItems;
        } else {
           $items = $user->sellItems;
        }

        return view(
            'user.profile',
            compact(
                'user',
                'items'
            )
        );
    }


    /**
     * プロフィール編集画面
     */
    public function showProfileEdit()
    {
        $user = Auth::user();

        return view('user/profile_edit', compact('user'));
    }

    /**
     * プロフィール更新
     */
    public function editProfile(ProfileRequest $request)
    {
        $user = Auth::user();

        $profilePhoto = $user->profile_photo;

        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');

            $file->storeAs(
                'profiles',
                $file->hashName(),
                'public'
            );

            $profilePhoto = $file->hashName();
        }

        $user->update([
            'name' => $request->name,
            'profile_photo' => $profilePhoto,
        ]);

        Address::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'postal_code' => $request->postal_code,
                'street_address' => $request->street_address,
                'building_name' => $request->building_name,
            ]
        );

        return redirect('/');
    }

    /**
     * 住所変更画面
     */
    public function showAddressEdit($item_id)
    {
        $address = Auth::user()->address;

        return view('user/address_change', compact(
            'address',
            'item_id'
        ));
    }

    /**
     * 住所変更
     */
    public function editAddress(AddressRequest $request, $item_id)
    {

        Address::updateOrCreate(
            [
                'user_id' => Auth::id()
            ],
            [
                'postal_code' => $request->postal_code,
                'street_address' => $request->street_address,
                'building_name' => $request->building_name,
            ]
        );

        return redirect("/purchase/{$item_id}");
    }
}