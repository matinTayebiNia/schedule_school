<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Unite\DestroyUniteRequest;
use App\Http\Requests\Admin\Unite\EditUniteRequest;
use App\Http\Requests\Admin\Unite\StoreUniteRequest;
use App\Http\Resources\Admin\Unit\ClassResources;
use App\Models\School;
use App\Models\Unit;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UnitController extends Controller
{

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-unites");

        $query = Unit::query();

        if ($word = request("search")) {
            $query->whereHas("class", function ($query) use ($word) {
                $query->whereHas("school", function ($q) use ($word) {
                    $q->where("name", "LIKE", "%{$word}%");
                });
            })->orWhereHas("teacher", function ($query) use ($word) {
                $query->where("family", "LIKE", "%{$word}%")
                    ->orWhere("personal_code", "LIKE", "%{$word}%");
            })->orWhereHas("lessen", function ($query) use ($word) {
                $query->where("name", "LIKE", "%{$word}%");
            });
        }

        $title = "واحد ها";

        $units = $query->latest()->paginate(7);

        return view("admin.units.index", compact("title", "units"));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Unit $unit): View
    {

        $this->authorize("see-unite");

        return view("admin.units.show", compact("unit"));

    }


    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create(): View
    {

        $this->authorize("create-unite");

        $title = "ساخت واحد";

        return view("admin.units.create", compact("title"));

    }

    public function store(StoreUniteRequest $request): RedirectResponse
    {
        $request->offsetUnset("school");

        Unit::create($request->all());

        return redirect(route("admin.units.index"))->with("success", "واحد مورد نظر با موفقیت ثبت شد");

    }

    /**
     * @param Unit $unit
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Unit $unit): View
    {

        $this->authorize("edit-unite");

        $title = "ویرایش واحد";

        return view("admin.units.edit", compact("title", "unit"));

    }

    /**
     * @param Unit $unit
     * @param EditUniteRequest $request
     * @return RedirectResponse
     */
    public function update(Unit $unit, EditUniteRequest $request): RedirectResponse
    {

        $request->offsetUnset("school");

        $unit->update($request->all());

        return redirect(route("admin.units.index"))->with("success", "واحد مورد نظر با موفقیت ویرایش شد");

    }

    /**
     * @param School $school
     * @return AnonymousResourceCollection
     */
    public function getClassOfSchool(School $school): AnonymousResourceCollection
    {
        return ClassResources::collection($school->classes);
    }

    /**
     * @param DestroyUniteRequest $request
     * @return RedirectResponse
     */
    public function destroy(DestroyUniteRequest $request): RedirectResponse
    {

        $unite = Unit::find($request->input("unit_id"));

        $unite?->delete();

        return redirect(route("admin.units.index"))->with("success", "واحد مورد نظر با موفقیت حذف شد");

    }
}
