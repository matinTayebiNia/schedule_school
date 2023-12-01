<?php

namespace App\Http\Controllers\Auth\Manger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        $title = "ورود معلم";
        return view("manger.auth.login", compact("title"));
    }

    /**
     * @throws ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        AuthService::login($request, "manger");

        return Redirect::route("manger.dashboard");
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        AuthService::logout($request, "manger");

        return Redirect::to("/");
    }

}
