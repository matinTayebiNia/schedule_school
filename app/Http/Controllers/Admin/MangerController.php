<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateMangerRequest;
use App\Http\Requests\Admin\DeleteMangerRequest;
use App\Http\Requests\Admin\EditMangerRequest;
use App\Models\Manger;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MangerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize("see-mangers");

        $query = Manger::query();

        if ($word = request("search")) {
            $query->where("name", "LIKE", "%{$word}%")
                ->orWhere("family", "LIKE", "%{$word}%")
                ->orWhere("phone", "LIKE", "%{$word}%")
                ->orWhere("personal_code", "LIKE", "%{$word}%");
        }

        $mangers = $query->latest()->paginate(7);

        $title = "مدیران";

        return view("admin.manger.index", compact('mangers', "title"));
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create-manger');

        $title = "ثبت مدیر";

        return view("admin.manger.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMangerRequest $request): RedirectResponse
    {
        Manger::create($request->validated());

        return Redirect::route("admin.manger.index")->with("success", "مدیر مورد نظر با موفقیت ثبت شد");
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Manger $manger): View
    {
        $this->authorize("see-manger");

        return view("admin.manger.show", compact("manger"));
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Manger $manger): View
    {
        $this->authorize('edit-manger');

        $title = "ویرایش مدیر";

        return view("admin.manger.edit", compact("manger"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditMangerRequest $request, Manger $manger): RedirectResponse
    {
        $manger?->update($request->validated());

        return Redirect::route("admin.manger.index")->with("success", "مدیر مورد نظر با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteMangerRequest $request): RedirectResponse
    {
        $manger=Manger::find($request->input("manger_id"));

        $manger?->delete();

        return Redirect::route("admin.manger.index")->with("success", "مدیر مورد نظر با موفقیت حذف شد");
    }
}
