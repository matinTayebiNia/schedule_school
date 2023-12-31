<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 * @property string $name;
 * @property string $family;
 * @property string $password;
 * @property string $phone;
 * @property string $personal_code;
 * @property string $address;
 * @property string $profile_image;
 * @property int $id
 *
 **/
class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        "name",
        "family",
        "password",
        "phone",
        "province_id",
        "city_id",
        "personal_code",
        "address",
        "profile_image"
    ];


    public function unit(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function activeCode(): MorphMany
    {
        return $this->morphMany(ActiveCode::class, 'userable');
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
