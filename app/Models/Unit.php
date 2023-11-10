<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property  string $class_id
 * @property  string $teacher_id
 * @property  string $lessen_id
 * @property string $weekday
 * @property string $start_time
 * @property string $end_time
 * @property string $student_limit
 *
 **/
class Unit extends Model
{
    use HasFactory;

    protected $table = "units";

    protected $fillable = [
        "class_id",
        "teacher_id",
        "lessen_id",
        "weekday",
        "start_time",
        "end_time",
        "student_limit"
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

    public function lessen(): BelongsTo
    {
        return $this->belongsTo(Lessen::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

}
