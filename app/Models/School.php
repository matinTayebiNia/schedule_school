<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $address
 *
 */
class School extends Model
{
    use HasFactory, SoftDeletes;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        "name",
        "code",
        "city",
        "state",
        "address",
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class, "school_id", "id");
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function manger(): HasOne
    {
        return $this->hasOne(Manger::class);
    }

}
