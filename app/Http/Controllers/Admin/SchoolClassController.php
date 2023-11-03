<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\class\editRequest;
use App\Models\School;
use App\Models\SchoolClass;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(School $school): View
    {
        $this->authorize("see-classes");

        $classes = $school->classes();

        if ($search = request("search")) {
            $classes->where('name', "LIKE", "%{$search}%");
        }

        $title = "کلاس های مدرسه " . $school->name;

        $classes = $classes->latest()->paginate(7);

        return view("admin.class.index", compact("classes", "title"));

    }


    /**
     * @param School $school
     * @throws AuthorizationException
     */
    public function save(School $school)
    {
        $this->authorize("create-class");
        //todo : implement validation and store classes for school

        //        $school->classes()->createMany();
    }

    /**
     * @param SchoolClass $class
     * @param int $school_id
     * @return View
     * @throws AuthorizationException
     */
    public function edit(SchoolClass $class, int $school_id): View
    {
        $this->authorize("edit-class");
        $title = "ویرایش کلاس";
        return view("admin.class.edit", compact("title", "class", 'school_id'));
    }

    /**
     * @param editRequest $request
     * @param SchoolClass $class
     * @param int $school_id
     * @return RedirectResponse
     */
    public function update(editRequest $request, SchoolClass $class, int $school_id):RedirectResponse
    {

        $class->update($request->all());

        return redirect(route("admin.class.index", ["school" => $school_id]))->with("success", "کلاس مورد نظر با موفقیت ویرایش شد ");

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->authorize("delete-class");

        $data = $request->validate([
            "class_id" => ["required", "numeric"],
            "school_id" => ["required", "numeric"]
        ]);

        $class = SchoolClass::find($data["class_id"]);

        $class?->delete();

        return redirect(route("admin.class.index", ["school" => $data["school_id"]]))->with('success', "کلاس مورد با موفقیت حذف شد");


    }
}
