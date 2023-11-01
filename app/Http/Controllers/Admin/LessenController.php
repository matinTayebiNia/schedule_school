<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lessen;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LessenController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-lessens");
        $query = Lessen::query();
        if ($search = request("search")) {
            $query->where("name", "LIKE", "%{$search}%")
                ->orWhere("code", "LIKE", "%{$search}%");
        }
        $lessens = $query->latest()->paginate(7);
        $title = "درس ها";
        return view("admin.lessen.index", compact("lessens", "title"));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {

            $this->authorize("delete-lessen");

            $data = $request->validate(["lessen_id" => ["required", "numeric"]]);

            $lessen = Lessen::find($data["lessen_id"]);

            $lessen?->delete();

            return redirect(route("admin.lessen.index"))->with("success", "درس مورد نظر با موفقیت حذف شد");

        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }


    }
}
