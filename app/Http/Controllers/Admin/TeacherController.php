<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::latest()->paginate(5);
        if ($search = \request("search")) {
            // todo : implement search query
        }
        return view("admin.teacher.index", compact("teachers"));
    }

    public function destroy(Request $request)
    {
        try {
            $data = $request->validate([
                "teacher_id" => "required|numeric"
            ]);
            $teacher = Teacher::find($data["teacher_id"]);
            $teacher?->delete();
            // todo : create admin routes
            return redirect(route("/"))->with("success", "معلم مورد نظر با موفقیت حدف شد");
        } catch (\Exception $exception) {
            abort(500);
        }

    }
}
