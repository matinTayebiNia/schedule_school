<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\DestroyRoleRequest;
use App\Http\Requests\Admin\Role\EditRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-roles");

        $query = Role::query();

        if ($word = request("search")) {
            $query->where("name", "LIKE", "%{$word}%")
                ->orWhere("label", "LIKE", "%{$word}%");
        }

        $roles = $query->latest()->paginate(7);

        $title = "مقام ها";

        return view("admin.roles.index", compact("title", "roles"));

    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {

        $this->authorize("create-role");

        $title = "ساخت مقام";

        $permissions = Permission::all();

        return view("admin.roles.create", compact("title", "permissions"));

    }

    /**
     * @param CreateRoleRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRoleRequest $request): RedirectResponse
    {

        $role = Role::create([
            "name" => $request->input("name"),
            "label" => $request->input("label")
        ]);

        $role->permissions()->attach($request->input("permissions"));

        return redirect(route("admin.roles.index"))->with("success", "مقام مورد نظر با موفقیت ثبت شد");

    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Role $role): View
    {

        $this->authorize("edit-role");

        $title = "ویرایش مقام";

        $permissions = Permission::all();

        return view("admin.roles.edit", compact("title", "role", "permissions"));

    }

    /**
     * @param Role $role
     * @param EditRoleRequest $request
     * @return RedirectResponse
     */
    public function update(Role $role, EditRoleRequest $request): RedirectResponse
    {

        $role->update([
            "name" => $request->input("name"),
            "label" => $request->input("label"),
        ]);

        $role->permissions()->sync($request->input("permissions"));

        return redirect(route("admin.roles.index"))->with("success", "مقام مورد نظر با موفقیت ویرایش شد");

    }

    /**
     * @param $role
     * @param DestroyRoleRequest $request
     * @return RedirectResponse
     */
    public function destroy($role, DestroyRoleRequest $request): RedirectResponse
    {

        $role = Role::find($request->input("role_id"));

        $role?->delete();

        return redirect(route("admin.roles.index"))->with("success", "مقام مورد نظر با موفقیت حذف شد");

    }

}
