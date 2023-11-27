<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = "school_classes";

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "name",
        "school_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, "school_id");
    }


    public function lessens(): HasMany
    {
        return $this->hasMany(Lessen::class, 'class_id', 'id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

}
