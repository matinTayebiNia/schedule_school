<?php

namespace App\services;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActiveCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class  AuthService
{

    public static $user;

    /**
     * @throws ValidationException
     */
    public static function login(LoginRequest $request, string $guard = "web")
    {
        $request->authenticate($guard);

        $request->session()->regenerate();
    }

    public static function createForgotCode(Request $request): Authenticatable|null
    {
        $authenticatable = static::$user::wherePhone($request->input("phone"))->first();
        if ($authenticatable) {
            ActiveCode::generateCode($authenticatable);

            $request->session()->flash('auth', [
                'user_id' => $authenticatable->id,
            ]);
        }
        return $authenticatable;
    }

    public static function verifyingCode(Request $request): array
    {
        $user = static::$user;
        $authenticatable = $user::findOrFail($request->session()->get('auth.user_id'));

        return ["status" => ActiveCode::verifyCode($request->input("code"), $authenticatable),
            "authenticatable" => $authenticatable];
    }

    public static function resendingCode(Request $request): string
    {
        $teacher = static::$user::findOrFail($request->session()->get('auth.user_id'));

        $request->session()->flash('auth', [
            'user_id' => $teacher->id,
        ]);

        return ActiveCode::generateCode($teacher);

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
