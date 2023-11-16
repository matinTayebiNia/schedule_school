<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use App\services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{

    public function __construct()
    {
        AuthService::$user = User::class;
    }


    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'phone' => ['required', 'numeric', "digits:11"],
        ], [
            "phone.required" => "تلفن وارد نشده",
            "phone.numeric" => "تلفن باید عدد باشد",
            "phone.digits" => 'شماره تلفن باید 11 عدد باشد'
        ]);

        $admin = AuthService::createForgotCode($request);

        if (!is_null($admin)) {
            return Redirect::route("password.reset")
                ->with("success","کد به شماره همراه شما ارسال شد");
        }


        throw ValidationException::withMessages([
            'phone' => "شماره وارد شده در پایگاه داده وجود ندارد.",
        ]);

    }
}
