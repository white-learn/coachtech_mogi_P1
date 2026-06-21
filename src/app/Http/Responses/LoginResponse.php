<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (! $request->user()->hasVerifiedEmail()) {
            return redirect('/authorization');
        }

        return redirect('/');
    }
}