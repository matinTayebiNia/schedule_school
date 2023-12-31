<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\services\AuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function __construct()
    {
        AuthService::$user = User::class;
    }

    /**
     * Display the password reset view.
     */
    public function create(Request $request): RedirectResponse|View
    {
        if (!$request->session()->has('auth')) {
            return redirect(route('login'));
        }
        $request->session()->reflash();

        return view('auth.reset-password');
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!$request->session()->has('auth')) {
            return redirect(route('login'));
        }

        $data = AuthService::verifyingCode($request);

        if (!$data["status"]) {
            $request->session()->reflash();
            throw ValidationException::withMessages([
                'code' => "کد وارد شده صحیح نمیباشد",
            ]);
        }

        $data["authenticatable"]->update([
            "password" => Hash::make($request->input("password"))
        ]);

        $data["authenticatable"]->activeCode()->delete();

        return Redirect::route("login")
            ->with("success", "رمز عبور شما تغییر کرد ، لطفا برای ورود به سیستم اقدام کنید.");

    }

    public function resend(Request $request): RedirectResponse
    {
        $code = AuthService::resendingCode($request);

        return Redirect::route("password.reset")
            ->with("success", "کد بازیابی رمز عبور به شماره شما ارسال شد");

    }
}
