<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {

        $this->authorize("see-teachers");
        $query = Teacher::query();
        $teachers = $query->latest()->paginate(7);
        if ($search = request("search")) {
            $query = $query->where("name", "LIKE", "%{$search}%")
                ->orWhere("family", "LIKE", "%{$search}%")
                ->orWhere("phone", "LIKE", "%$search%")
                ->orWhere("personal_code", "LIKE", "%$search%");
            $teachers = $query->latest()->paginate(7);
        }
        return view("admin.teacher.index", compact("teachers"));

    }

    public function destroy(Request $request)
    {

        try {
            $this->authorize("delete-teacher");
            $data = $request->validate([
                "teacher_id" => "required|numeric"
            ]);
            $teacher = Teacher::find($data["teacher_id"]);
            $teacher?->delete();
            // todo : create admin teacher routes
            return redirect(route("admin.teacher.index"))->with("success", "معلم مورد نظر با موفقیت حدف شد");
        } catch (Exception $exception) {
            abort(500);
        }

    }
}
