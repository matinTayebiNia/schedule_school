<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
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
        "school_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function lessens(): HasMany
    {
        return $this->hasMany(Lessen::class, "class_id", "id");
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
