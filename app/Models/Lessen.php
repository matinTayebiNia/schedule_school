<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        "start_time",
        "end_time",
        "school_id",
        "class_id",
        "teacher_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    const WEEK_DAYS = [
        '1' => 'Saturday',
        '2' => 'Sunday',
        '3' => 'Monday',
        '4' => 'Tuesday',
        '5' => 'Wednesday',
        '6' => 'Thursday',
        '7' => 'Friday',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class,"class_id");
    }

    public function teacher()
    {

    }

    public function getDifferenceAttribute(): int
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

}
