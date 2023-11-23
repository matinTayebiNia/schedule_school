<?php

namespace App\services;

use App\Models\Unit;

class CalendarService
{

    /**
     * @param array $weekdays
     * @return array
     */
    public function generateCalendarData(array $weekdays): array
    {
        $calendarData = [];

        $timeRange = TimeService::generateTimeRange(config('panel.calendar.start_time'),
            config('panel.calendar.end_time'));

        $units = $this->getUnits();

        foreach ($timeRange as $time) {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekdays as $index => $day) {
                $unit = $units->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($unit) {
                    $calendarData[$timeText][] = [
                        "unit_id" => $unit->id,
                        'class_name' => $unit->class->school->name . "(" . $unit->class->name . ")",
                        'teacher_name' => $unit->teacher->name . " " . $unit->teacher->family,
                        "lessen_name" => $unit->lessen->name,
                        'rowspan' => $unit->difference / 30 ?? ''
                    ];
                } else if (!$units->where('weekday', $index)
                    ->where('start_time', '<', $time['start'])->
                    where('end_time', '>=', $time['end'])->count()) {
                    $calendarData[$timeText][] = 1;
                } else {
                    $calendarData[$timeText][] = 0;
                }
            }

        }
        return $calendarData;
    }

    /**
     * @param string|null $school
     * @return mixed
     */
    public function getUnits(string $school = null): mixed
    {
        return Unit::with('class', 'teacher', "lessen")
            ->calendarByRoleOrUnitId($school)
            ->get();
    }

}
