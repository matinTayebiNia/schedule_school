<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\school\DestroySchoolRequest;
use App\Models\School;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-schools");
        $query = School::query();
        if ($search = request("search")) {
            $query->where("name", "LIKE", "%{$search}%");
            $query->orWhere("code", "LIKE", "%{$search}%");
        }
        $schools = $query->latest()->paginate(7);
        $title = "مدارس";
        return view("admin.school.index", compact("schools", "title"));
    }

    /**
     * @param School $school
     * @return View
     * @throws AuthorizationException
     */
    public function show(School $school):View
    {

        $this->authorize("see-school");

        return view("admin.school.show", compact("school"));

    }

    /**
     * @param DestroySchoolRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(DestroySchoolRequest $request): RedirectResponse
    {

        $school = School::find($request->input("school_id"));

        $school?->delete();

        return redirect(route("admin.school.index"))->with("success", "مدرسه مورد نظر با موفقیت حذف شد");

    }
}
