<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Permission;
use App\Models\Teacher;
use App\Models\Unit;
use App\Models\User;
use App\Policies\UnitPolicy;
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
        Unit::class => UnitPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Permission::all()->map(
            fn(Permission $item) => Gate::define($item->name,
                fn(Authenticatable $user) => $user instanceof User ?
                    $user->hesAllowed($item) :
                    false));


        $this->registerPolicies();


//        dd(Gate::abilities());
    }
}
