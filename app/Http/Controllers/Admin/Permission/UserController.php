<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserAdmin\DestroyRequest;
use App\Http\Requests\Admin\UserAdmin\SetPermissionRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {

        $query = User::query();

        if ($word = request("search")) {
            $query->where("name", "LIKE", "%{$word}%")
                ->orWhere("family", "LIKE", "%{$word}%")
                ->orWhere("phone", "LIKE", "%{$word}%")
                ->orWhere("personal_code", "LIKE", "%{$word}%");
        }

        $users = $query->latest()->paginate(7);

        $title = "کاربران ادمین ";

        return view("admin.user_admin.index", compact('users', "title"));

    }

    /**
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function show(User $user): View
    {
        $this->authorize("see-user");

        return view("admin.user_admin.show", compact("user"));
    }

    /**
     * @throws AuthorizationException
     */
    public function permissions(User $user): View
    {

        $this->authorize("allow-to-set-permission");

        $title = "ثبت دسترسی برای کاربر ادمین";

        return view("admin.user_admin.user_permission", compact("user", "title"));

    }

    /**
     * @param User $user
     * @param SetPermissionRequest $request
     * @return RedirectResponse
     */
    public function setPermissions(User $user, SetPermissionRequest $request): RedirectResponse
    {

        $user->permissions()->sync($request->input("permissions"));

        $user->roles()->sync($request->input("roles"));

        return redirect(route("admin.users.index"))->with("success", "دسترسی و مقام های مورد نظر با موفقیت برای کاربر مورد نظر ثبت شد");

    }

    /**
     * @param DestroyRequest $request
     * @return RedirectResponse
     */
    public function destroy(DestroyRequest $request): RedirectResponse
    {

        if ($request->user()->id != $request->input("user_id")) {

            $user = User::find($request->input("user_id"));

            $user?->delete();

        }

        return redirect(route("admin.users.index"))->with("success", "کاربر ادمین با موفقیت حذف شد .");
    }
}
