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
use Illuminate\Validation\ValidationException;

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

        return view("student.units.index", compact("weekdays", "calendarData"));

    }

    /**
     * @param Unit $unit
     * @return View
     * @throws AuthorizationException
     */
    public function show(Unit $unit): View
    {
        $this->authorize("view_unit_student", $unit);

        return view("student.units.show", compact("unit"));
    }

    /**
     * @param string $school
     * @param CalendarService $calendarService
     * @return View
     */
    public function create(string $school, CalendarService $calendarService): View
    {
        $title = "ثبت انتخاب واحد";

        $units = $calendarService->getUnits($school);

        return view("student.units.create", compact("title", "units"));
    }

    /**
     * @param CreateStudentRequest $request
     * @return RedirectResponse
     */
    public function store(CreateStudentRequest $request): RedirectResponse
    {

        $units = collect($request->input("units"));

        $units->map(function ($unit) {
            $data = Unit::find($unit);
            if ($data->students->count() > $data->student_limit) {
                throw ValidationException::withMessages([
                    'unit' => "درس {$data->lessen->name} با مدرس {$data->teacher->name} {$data->teacher->family} هیچ ظرفیتی ندارد",
                ]);
            }
            $student = $data->students()->where("student_id", auth("student")->user()->id)->first();
            if ($student) {
                throw ValidationException::withMessages([
                    'unit' => "درس {$data->lessen->name} با مدرس {$data->teacher->name} {$data->teacher->family} برای شما ثبت شده است.",
                ]);
            }
        });

        auth("student")->user()->units()->sync($units->toArray());

        return redirect(route("student.units.index"))->with("success", "واحد های مورد نظر ثبت شد.");
    }
}
