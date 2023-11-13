<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Unit;
use App\services\CalendarService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CalendarService $calendarService): View
    {
        $weekdays = Unit::WEEK_DAYS;
        $calendarData = $calendarService->generateCalendarData($weekdays);

        return view("teacher.unit.index", compact("weekdays", "calendarData"));

    }


    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Unit $unit): View
    {
        $this->authorize("view", $unit->id);

        return view("teacher.unit.show", compact("unit"));

    }

}
