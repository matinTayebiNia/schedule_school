<?php

namespace App\services;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class  AuthService
{
    /**
     * @throws ValidationException
     */
    public static function login(LoginRequest $request, string $guard="web")
    {
        $request->authenticate($guard);

        $request->session()->regenerate();
    }

    /**
     * @param string $guard
     * @param Request $request
     * @return void
     */
    public static function logout(Request $request, string $guard = "web")
    {
        Auth::guard($guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
