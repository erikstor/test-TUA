<?php

namespace App\Http\Responses;

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Contracts\LogoutResponse as FortifyLogoutResponse;

class LogoutResponse implements FortifyLogoutResponse
{

    public function toResponse($request)
    {
        return redirect(RouteServiceProvider::HOME);
    }
}
