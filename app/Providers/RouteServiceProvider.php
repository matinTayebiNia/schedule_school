<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const ADMIN_HOME = '/admin/dashboard';

    public const TEACHER_HOME = '/teacher/dashboard';

    public const STUDENT_HOME = '/student/dashboard';

    public const MANGER_HOME = '/manger/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/web.php'));

            Route::middleware(['web', "auth",])->name("admin.")->prefix("/admin")
                ->group(base_path('routes/web/admin.php'));

            Route::prefix("/teacher")->name("teacher.")->middleware(["web", "auth:teacher"])
                ->group(base_path("routes/web/teacher.php"));

            Route::prefix("/student")->name("student.")->middleware(["web", "auth:student"])
                ->group(base_path("routes/web/student.php"));

            Route::prefix("/manger")->name("manger.")->middleware(["web", "auth:manger"])
                ->group(base_path("routes/web/manger.php"));
        });
    }
}
