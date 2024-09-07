<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        auth()->logout();

        return redirect()->route('homepage');
    }
}
