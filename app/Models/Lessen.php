<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property  integer $class_id
 * @property  string $teacher_id
 * @property  string $lessen_id
 * @property string $weekday
 * @property string $start_time
 * @property string $end_time
 * @property string $student_limit
 *
 **/
class Lessen extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "name",
        "class_id",
        "teacher_id",
        "weekday",
        "start_time",
        "end_time",
        "student_limit",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    const WEEK_DAYS = [
        1 => 'شنبه',
        2 => 'یکشنبه',
        3 => 'دوشنبه',
        4 => 'سه شنبه',
        5 => 'چهارشنبه',
        6 => 'پنج شنبه',
        7 => 'جمعه',
    ];

    public function convertToPersianDay(): string
    {
        return self::WEEK_DAYS[$this->weekday];
    }

    public function getDifferenceAttribute(): int
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function getStartTimeAttribute($value): ?string
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value): ?string
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
            $value)->format('H:i:s') : null;
    }

    function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }


    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public static function isTimeAvailable($weekday, $startTime, $endTime, $class, $teacher, $lesson): bool
    {
        $lessons = self::where('weekday', $weekday)
            ->when($lesson, function ($query) use ($lesson) {
                $query->where('id', '!=', $lesson);
            })
            ->where(function ($query) use ($class, $teacher) {
                $query->where('class_id', $class)
                    ->orWhere('teacher_id', $teacher);
            })
            ->where([
                ['start_time', '<', $endTime],
                ['end_time', '>', $startTime],
            ])
            ->count();

        return !$lessons;
    }


    /**
     * @param $query
     * @param null $school
     * @return mixed
     */
    public function scopeCalendarByRoleOrUnitId($query, $school = null): mixed
    {
        return $query->when(is_null($school), function ($query) {
            if (Auth::guard('teacher')->check())
                $query->where('teacher_id', auth("teacher")->user()->id);
            else if (Auth::guard('student')->check())
                $query->where("class_id", Auth::guard("student")->user()->class_id);
        })
            ->when(!is_null($school), function ($query) use ($school) {
                $query->whereHas("class", function ($query) use ($school) {
                    $query->whereHas("school", function ($query) use ($school) {
                        $query->where("id", $school);
                    });
                });
            });
    }
}
