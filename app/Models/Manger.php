<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property integer $school_id;
 * @property string $city;
 * @property string $state;
 *
 **/

class Manger extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "family",
        "password",
        "phone",
        "personal_code",
        "province_id",
        "city_id",
        "address",
        "profile_image",
        "school_id"
    ];

    protected $guarded = ["id"];

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
