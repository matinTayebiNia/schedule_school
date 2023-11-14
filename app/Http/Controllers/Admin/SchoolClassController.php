<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\class\CreateRequest;
use App\Http\Requests\Admin\class\DeleteRequest;
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

        $title = "کلاس های مدرسه " . $school->name;

        $classes = $school->classes()->latest()->paginate(7);

        return view("admin.class.index", compact("classes", "title"));

    }


    /**
     * @param School $school
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function save(School $school, CreateRequest $request): RedirectResponse
    {

        $school->classes()->createMany($request->input("classes"));

        return redirect(route("admin.class.index", $school->id))
            ->with("success", "کلاس های مورد نظر با موفقیت ثبت شد.");

    }

    /**
     * @param SchoolClass $class
     * @param int $school
     * @return View
     * @throws AuthorizationException
     */
    public function edit(int $school, SchoolClass $class): View
    {
        $this->authorize("update-class");
        $title = "ویرایش کلاس";
        return view("admin.class.edit", compact("title", "class", 'school'));
    }

    /**
     * @param editRequest $request
     * @param int $school
     * @param SchoolClass $class
     * @return RedirectResponse
     */
    public function update(editRequest $request, int $school, SchoolClass $class): RedirectResponse
    {

        $class->update($request->all());

        return redirect(route("admin.class.index", ["school" => $school]))
            ->with("success", "کلاس مورد نظر با موفقیت ویرایش شد ");

    }

    /**
     * @param DeleteRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(DeleteRequest $request): RedirectResponse
    {

        $class = SchoolClass::find($request->input("class_id"));

        $class?->delete();

        return redirect(route("admin.class.index", ["school" => $request->route()->school]))
            ->with('success', "کلاس مورد با موفقیت حذف شد");


    }
}
