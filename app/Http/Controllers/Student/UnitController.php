<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Models\School;
use App\Models\Unit;
use App\services\CalendarService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * @param CalendarService $calendarService
     * @return View
     */
    public function index(CalendarService $calendarService): View
    {
        $weekdays = Unit::WEEK_DAYS;

        $calendarData = $calendarService->generateCalendarData($weekdays);

        return view("student.unit.index", compact("weekdays", "calendarData"));

    }

    /**
     * @param Unit $unit
     * @return View
     * @throws AuthorizationException
     */
    public function show(Unit $unit): View
    {
        $this->authorize("view_unit_student", $unit);

        return view("student.unit.show", compact("unit"));
    }

    /**
     * @param string $school
     * @param CalendarService $calendarService
     * @return View
     */
    public function create(string $school,CalendarService $calendarService): View
    {
        $title = "ثبت انتخاب واحد";

        $units = $calendarService->getUnits();

        return view("student.unit.create", compact("title", "units"));

    }

    /**
     * @param CreateStudentRequest $request
     * @return RedirectResponse
     */
    public function store(CreateStudentRequest $request): RedirectResponse
    {
        dd($request->all());
        auth("student")->user()->units()->sync($request->input("units"));

        return redirect(route("student.units.index"))->with("success", "واحد های مورد نظر ثبت شد.");
    }
}
