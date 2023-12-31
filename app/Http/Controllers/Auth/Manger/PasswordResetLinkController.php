<?php

namespace App\Http\Controllers\Auth\Manger;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\Manger;
use App\services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:manger");
        AuthService::$user = Manger::class;
    }

    public function create(): View
    {
        return view("manger.auth.forgot");
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'numeric',"digits:11"],
        ],[
            "phone.required"=>"تلفن وارد نشده",
            "phone.numeric"=>"تلفن باید عدد باشد",
            "phone.digits"=>'شماره تلفن باید 11 عدد باشد'
        ]);

        $teacher = AuthService::createForgotCode($request);

        if (!is_null($teacher)) {
            return Redirect::route("manger.reset.password")
                ->with("success","کد به شماره همراه شما ارسال شد");

        }

        throw ValidationException::withMessages([
            'phone' => "شماره وارد شده در پایگاه داده وجود ندارد.",
        ]);

    }

}
