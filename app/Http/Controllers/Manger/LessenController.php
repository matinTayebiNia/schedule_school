<?php

namespace App\Http\Controllers\Manger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\student\DestroyStudentRequest;
use App\Http\Requests\Manger\Lessen\CreateLessonRequest;
use App\Http\Requests\Manger\lessen\DestroyLessonRequest;
use App\Http\Requests\Manger\lessen\UpdateLessonRequest;
use App\Models\Lessen;
use App\Models\School;
use App\services\CalendarService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LessenController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(School $school, CalendarService $service): View
    {

        $this->authorize("view_classes",$school->id);

        $weekdays = Lessen::WEEK_DAYS;

        $data = $service->generateCalendarData($weekdays, $school->id);
        //todo : implement index lessen view

        return view("manger.lessen.index", compact("weekdays", "data"));

    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize("create-lessen");

        $title = "ثبت درس";
        //todo : implement create lessen view

        return view("manger.lessen.create", compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLessonRequest $request): RedirectResponse
    {

        Lessen::create($request->validated());

        return Redirect::route("manger.lessen.index")->with("success", "درس مورد نظر با موفقیت ثبت شد");

    }


    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Lessen $lessen): View
    {
        $this->authorize("update-lessen");

        $title = "ویرایش درس";

        //todo : implement edit lessen view

        return view("manger.lessen.edit", compact("lessen", "title"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lessen $lessen): RedirectResponse
    {
        $lessen?->update($request->validated());

        return Redirect::route("manger.lessen.index")->with("success", "درس مورد نظر با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyLessonRequest $request): RedirectResponse
    {
        $lessen = Lessen::find($request->input("lessen_id"));

        $lessen?->delete();

        return Redirect::route("manger.lessen.index")->with("success", "درس مورد نظر با موفقیت حذف شد");

    }
}
