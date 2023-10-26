<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        "code",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }



}
