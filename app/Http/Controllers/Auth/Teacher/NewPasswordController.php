<?php

namespace App\Http\Controllers\Auth\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\Teacher;
use App\services\AuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
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
        $this->middleware("guest:teacher");
        AuthService::$user = Teacher::class;
    }

    public function reflashSession(Request $request)
    {
        if (!$request->session()->has('auth')) {
            return redirect(route('teacher.login'));
        }
        $request->session()->reflash();
    }

    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function create(Request $request): RedirectResponse|View
    {
//        dd($request->session()->get("auth"));
        $this->reflashSession($request);

        return view("teacher.auth.rest-password");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', "numeric"],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!$request->session()->has('auth')) {
            return redirect(route('teacher.login'));
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

        return Redirect::route("teacher.login")->with("success", "رمز عبور شما تغییر کرد ، لطفا برای ورود به سیستم اقدام کنید.");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resend(Request $request): RedirectResponse
    {

        $code = AuthService::resendingCode($request);

        return Redirect::route("teacher.reset.password")
            ->with("success", "کد بازیابی رمز عبور به شماره شما ارسال شد");
    }

}
