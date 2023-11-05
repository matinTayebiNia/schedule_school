<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\student\DestroyStudentRequest;
use App\Models\Student;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-students");
        $query = Student::query();
        if ($search = request("search")) {
            $query->where("name", "LIKE", "%{$search}%")
                ->orWhere("family", "LIKE", "%{$search}%")
                ->orWhere("personal_code", "LIKE", "%$search%");
        }
        $students = $query->latest()->paginate(7);
        $title = "دانش آموزان";
        return view("admin.student.index", compact("students", "title"));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Student $student): View
    {
        $this->authorize("see-student");
        $title = $student->name . " " . $student->family;
        return view("admin.student.show", compact('title', "student"));

    }

    /**
     * @param DestroyStudentRequest $request
     * @return RedirectResponse
     */
    public function destroy(DestroyStudentRequest $request): RedirectResponse
    {

        $student = Student::find($request->input("student_id"));

        $student?->delete();

        return redirect(route("admin.student.index"))->with("success", "دانش آموز مورد نظر با موفقیت حذف شد");

    }
}
