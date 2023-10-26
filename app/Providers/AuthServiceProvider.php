<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User as Authenticatable;

;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
       /* Gate::before(fn(Authenticatable $user) => $user instanceof User ? $user->isSuperuser() : false);

        Permission::all()->map(
            fn(Permission $item) => Gate::define($item->name,
                fn(Authenticatable $user) => $user instanceof User ?
                    $user->hesAllowed($item) :
                    false));*/

        $this->registerPolicies();

    }
}
