<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

if (!function_exists("unsetPasswordIfIsNull")) {
    function unsetPasswordIfIsNull(array $data): array
    {
        if ($data["password"] == "")
            unset($data["password"]);
        else
            $data["password"] = Hash::make($data["password"]);
        return $data;
    }
}
if (!function_exists("generatePasswordForNewUser")) {

    /**
     * @param string $password
     * @param string $personal_code
     * @return string
     */
    function generatePasswordForNewUser(string $personal_code, string $password = "",): string
    {
        if ($password == "") {
            return Hash::make($personal_code);
        }
        return Hash::make($password);
    }
}

if (!function_exists("isActive")) {
    /**
     * @param string|array $routeName
     * @param string $activeClasses
     * @return string|null
     */
    function isActive(string|array $routeName, string $activeClasses = "active"): ?string
    {
        if (is_array($routeName)) {
            foreach ($routeName as $item) {
                if ($item == Route::currentRouteName() || $routeName == Route::current()->uri()) {
                    return $activeClasses;
                }
            }
        } else
            if ($routeName == Route::currentRouteName() || $routeName == Route::current()->uri()) {
                return $activeClasses;
            }
        return null;
    }
}
