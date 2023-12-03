<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 * @property int $id;
 * @property string $name;
 * @property string $family;
 * @property string $password;
 * @property string $personal_code;
 * @property string $address;
 * @property string $profile_image;
 *
 **/
class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        "name",
        "family",
        "password",
        "personal_code",
        "address",
        "province_id",
        "city_id",
        "profile_image",
        "school_id"
    ];

    protected $guarded = ["id"];


    public function SchoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);

    }

}
