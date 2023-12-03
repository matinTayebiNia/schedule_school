<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function mangers(): HasMany
    {
        return $this->hasMany(Manger::class);
    }

    public function admins(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }
}

