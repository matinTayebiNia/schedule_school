<?php

use Illuminate\Support\Facades\Route;

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
